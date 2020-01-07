<?php

namespace app\modules\v1\controllers;

use app\modules\v1\models\User;
use Yii;
use yii\base\Exception;
use yii\base\InvalidConfigException;
use yii\data\ActiveDataProvider;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\Cors;
use yii\helpers\ArrayHelper;
use yii\rest\ActiveController;

use app\modules\v1\models\UserAttributes;
use yii\web\ForbiddenHttpException;

class UserController extends ActiveController {

    public $modelClass = 'app\modules\v1\models\UserAttributes';

    public function behaviors()
    {
        $behaviors = ArrayHelper::merge(parent::behaviors(), [
            'corsFilter' => [
                'class' => Cors::className(),
            ],
        ]);
        $behaviors['authenticator']['class'] = HttpBearerAuth::className();
        $behaviors['authenticator']['only'] = ['create', 'update', 'delete', 'view', 'index'];


        return $behaviors;
    }

    public function actions(){
        $actions = parent::actions();
        unset($actions['index']);
        return $actions;
    }

    public function actionIndex(){
        $model = new UserAttributes;
        $activeData = new ActiveDataProvider([
            'query' => $model::find()->orderBy("id DESC"),
        ]);
        return $activeData;
    }

    public function actionLogin(){
        $response = array();
        try {
            $request['query'] = Yii::$app->getRequest()->getBodyParams();
            $phone = User::trimPhone($request['query']['phone']);
            $password = $request['query']['password'];
            $identity = User::findByUsername($phone);
            if ($identity && password_verify($password, $identity->password)) {
                if(isset($request['query']['session'])){
                    $session = $request['query']['session'];
                    $identity->session = $session;
                    $identity->save();
                }
                $profile = UserAttributes::findById($identity->id);
                $profile->lastlogin = time();
                $profile->save();
                $response = [
                    'result' => 'success',
                    'message' => 'Успешная авторизация',
                    'data' => [
                        'id' => $profile->id,
                        'phone' => $profile->phone,
                        'fullname' => $profile->fullname,
                        'email' => $profile->email,
                        'photo' => $profile->photo,
                        'locality' => $profile->locality,
                        'role' => Yii::$app->authManager->getRolesByUser($identity->id),
                        'token' => $identity->token,
                    ],
                ];
            } else {
                $response = [
                    'result' => 'error',
                    'message' => 'Логин или пароль не верный.',
                ];
            }

        } catch (InvalidConfigException $e) {
        }

        return $response;
    }

    public function actionRegistration(){
        $response = array();
        try {
            $request['query'] = Yii::$app->getRequest()->getBodyParams();
            if(!User::issetUser(User::trimPhone($request['query']['phone']))) {

                $phone = User::trimPhone($request['query']['phone']);
                $fullname = $request['query']['fullname'];
                $password = User::generatePassword(8);

                $identity = new User;
                $identity->username = $phone;
                $identity->password = password_hash($password, PASSWORD_DEFAULT);
                try {
                    $identity->token = Yii::$app->security->generateRandomString(64);
                } catch (Exception $e) {
                }
                $identity->save();
                $auth = Yii::$app->authManager;
                $authorRole = $auth->getRole('user');
                $auth->assign($authorRole, $identity->id);

                if ($identity) {
                    $profile = new UserAttributes;
                    $profile->fullname = $fullname;
                    $profile->phone = $phone;
                    $profile->internalKey = $identity->id;
                    $profile->locality_id = 25;
                    $profile->save();
                    if ($profile) {
                        $response = [
                            'result' => 'success',
                            'message' => 'Пользователь '.$fullname.' успешно зарегистрирован. Ваш пароль: '.$password,
                            'data' => [
                                'id' => $profile->id,
                                'phone' => $profile->phone,
                                'fullname' => $profile->fullname,
                                'email' => $profile->email,
                                'photo' => $profile->photo,
                                'locality' => $profile->locality,
                                'role' => Yii::$app->authManager->getRolesByUser($identity->id),
                                'token' => $identity->token,
                            ],
                        ];

                    } else {
                        $response = [
                            'result' => 'error',
                            'message' => 'Ошибка регистрации пользователя, попробуйте еще раз.',
                        ];
                    }

                } else {
                    $response = [
                        'result' => 'error',
                        'message' => 'Ошибка регистрации пользователя, попробуйте еще раз.',
                    ];
                }
            }else{
                $response = [
                    'result' => 'error',
                    'message' => 'Пользователь с таким номером телефона существует.',
                ];
            }


        } catch (InvalidConfigException $e) {

        } catch (\Exception $e) {
        }

        return $response;
    }

    /**
     * @param string $action
     * @param null $model
     * @param array $params
     * @throws ForbiddenHttpException
     */
    public function checkAccess($action, $model = null, $params = []){
        if ($action === 'update') {
            if (!empty($model->internalKey))
                if ($model->internalKey !== Yii::$app->user->identity['id'])
                    throw new ForbiddenHttpException(sprintf('You can only %s articles that you\'ve created.', $action));
        } elseif ($action === 'index') {
            if(!isset(Yii::$app->authManager->getRolesByUser(Yii::$app->user->identity['id'])['root']))
                throw new ForbiddenHttpException(sprintf('You can only %s articles that you\'ve created.', $action));
        } elseif ($action === 'view') {
            if (!empty($model->internalKey))
                if ($model->internalKey !== Yii::$app->user->identity['id'])
                    if(!isset(Yii::$app->authManager->getRolesByUser(Yii::$app->user->identity['id'])['root']))
                        throw new ForbiddenHttpException(sprintf('You can only %s articles that you\'ve created.', $action));
        } elseif ($action === 'delete') {
            throw new ForbiddenHttpException(sprintf('You can only %s articles that you\'ve created.', $action));
        } elseif ($action === 'create') {
            throw new ForbiddenHttpException(sprintf('You can only %s articles that you\'ve created.', $action));
        }
    }
}