<?php
namespace app\modules\v1\controllers;

use app\modules\v1\models\Request;
use Yii;
use yii\web\HttpException;
use yii\base\InvalidConfigException;
use yii\data\ActiveDataProvider;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\Cors;
use yii\helpers\ArrayHelper;
use yii\rest\ActiveController;
use yii\web\ForbiddenHttpException;

class RequestController extends ActiveController {

    public $modelClass = 'app\modules\v1\models\Request';

    public function behaviors()
    {
        $behaviors = ArrayHelper::merge(parent::behaviors(), [
            'corsFilter' => [
                'class' => Cors::className(),
            ],
        ]);
        $behaviors['authenticator']['class'] = HttpBearerAuth::className();
        $behaviors['authenticator']['only'] = ['create', 'delete', 'index', 'view'];


        return $behaviors;
    }

    public function actions(){
        $actions = parent::actions();
        unset($actions['index'], $actions['create']);
        return $actions;
    }

    /**
     * @return ActiveDataProvider
     */
    public function actionIndex(){
        $model = new Request;
        $activeData = new ActiveDataProvider([
            'query' => $model::find()->where(array('user_id' => Yii::$app->user->identity['id']))->orderBy("id DESC"),
        ]);
        return $activeData;
    }

    /**
     * @return Request
     * @throws HttpException
     */
    public function actionCreate(){
        $response = array();
        try {
            $request = Yii::$app->getRequest()->getBodyParams();
            if(Request::isRequest(Yii::$app->user->identity['id'], $request['event_id'])){
                $requestObject = new Request;
                $requestObject->user_id = Yii::$app->user->identity['id'];
                $requestObject->event_id = intval($request['event_id']);
                $requestObject->request = $request['request'];
                $requestObject->createdon = time();
                $requestObject->save();
                $response = $requestObject;
            }else{
                throw new HttpException(500, sprintf('Object already exist'), 485);
            }

        } catch (InvalidConfigException $e) {
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
            throw new ForbiddenHttpException(sprintf('You can only %s articles that you\'ve created.', $action));
        } elseif ($action === 'delete') {
            if (!empty($model->user_id))
                if ($model->user_id !== Yii::$app->user->identity['id'])
                    throw new ForbiddenHttpException(sprintf('You can only %s articles that you\'ve created.', $action));
        } elseif ($action === 'view') {
            if (!empty($model->user_id))
                if ($model->user_id !== Yii::$app->user->identity['id'])
                    throw new ForbiddenHttpException(sprintf('You can only %s articles that you\'ve created.', $action));
        }
    }
}