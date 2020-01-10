<?php
namespace app\modules\v1\controllers;

use app\modules\v1\models\Status;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\Cors;
use yii\helpers\ArrayHelper;
use yii\rest\ActiveController;
use yii\web\ForbiddenHttpException;

class StatusController extends ActiveController {

    public $modelClass = 'app\modules\v1\models\Status';

    public function behaviors()
    {
        $behaviors = ArrayHelper::merge(parent::behaviors(), [
            'corsFilter' => [
                'class' => Cors::className(),
            ],
        ]);
        $behaviors['authenticator']['class'] = HttpBearerAuth::className();
        $behaviors['authenticator']['only'] = ['create', 'update', 'delete', 'index', 'view'];


        return $behaviors;
    }

    public function actions(){
        $actions = parent::actions();
        unset($actions['index'], $actions['create'], $actions['update'], $actions['view']);
        return $actions;
    }

    /**
     * @return ActiveDataProvider
     */
    public function actionIndex(){
        $model = new Status;
        $activeData = new ActiveDataProvider([
            'query' => $model::find()->where(array('user_id' => Yii::$app->user->identity['id']))->orWhere(array('user_id' => 1))->orderBy("id DESC"),
        ]);
        return $activeData;
    }

    /**
     * @param $id
     * @return Status
     * @throws ForbiddenHttpException
     */
    public function actionView($id){
        $status = Status::findOne($id);
        if(($status->user_id == Yii::$app->user->identity['id']) || $status->user_id == 1){
            return $status;
        }else{
            throw new ForbiddenHttpException(sprintf('You can only create articles that you\'ve created.'));
        }
    }

    /**
     * @return Status
     * @throws ForbiddenHttpException
     */
    public function actionCreate(){
        if(!isset(Yii::$app->authManager->getRolesByUser(Yii::$app->user->identity['id'])['root']))
            if(!isset(Yii::$app->authManager->getRolesByUser(Yii::$app->user->identity['id'])['administrator']))
                if(!isset(Yii::$app->authManager->getRolesByUser(Yii::$app->user->identity['id'])['manager']))
                    throw new ForbiddenHttpException(sprintf('You can only create articles that you\'ve created.'));

        $params = (array)json_decode(Yii::$app->getRequest()->getRawBody());
        $status = new Status;
        $status->user_id =     Yii::$app->user->identity['id'];
        $status->name =        $params['name'];
        $status->alias =       Status::translit($params['name']);
        $status->save();
        return $status;
    }

    /**
     * @param $id
     * @return Status
     * @throws ForbiddenHttpException
     */
    public function actionUpdate($id){
        $status = Status::findOne($id);
        if(!isset(Yii::$app->authManager->getRolesByUser(Yii::$app->user->identity['id'])['root']))
            if (!empty($status->user_id))
                if ($status->user_id !== Yii::$app->user->identity['id'])
                    if(!isset(Yii::$app->authManager->getRolesByUser(Yii::$app->user->identity['id'])['administrator']))
                        if(!isset(Yii::$app->authManager->getRolesByUser(Yii::$app->user->identity['id'])['manager']))
                            throw new ForbiddenHttpException(sprintf('You can only update articles that you\'ve created.'));

        $params = (array)json_decode(Yii::$app->getRequest()->getRawBody());
        $status->name =        $params['name'];
        $status->alias =       Status::translit($params['name']);
        $status->save();
        return $status;
    }

    /**
     * @param string $action
     * @param null $model
     * @param array $params
     * @throws ForbiddenHttpException
     */
    public function checkAccess($action, $model = null, $params = []){
        if ($action === 'delete') {
            if(!isset(Yii::$app->authManager->getRolesByUser(Yii::$app->user->identity['id'])['root']))
                if (!empty($model->user_id))
                    if ($model->user_id !== Yii::$app->user->identity['id'])
                        if(!isset(Yii::$app->authManager->getRolesByUser(Yii::$app->user->identity['id'])['administrator']))
                            if(!isset(Yii::$app->authManager->getRolesByUser(Yii::$app->user->identity['id'])['manager']))
                                throw new ForbiddenHttpException(sprintf('You can only %s articles that you\'ve created.', $action));
        }
    }
}