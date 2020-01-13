<?php
namespace app\modules\v1\controllers;

use app\modules\v1\models\Event;
use app\modules\v1\models\Organization;
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
        $behaviors['authenticator']['only'] = ['create', 'delete', 'update', 'index', 'view'];

        return $behaviors;
    }

    public function actions(){
        $actions = parent::actions();
        unset($actions['index'], $actions['create'], $actions['update']);
        return $actions;
    }

    /**
     * @api {get} /v1/request Список заявок
     * @apiName Index
     * @apiGroup Request
     * @apiVersion 1.0.0
     *
     */
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
     * @api {post} /v1/request Создание заявки
     * @apiName Create
     * @apiGroup Request
     * @apiVersion 1.0.0
     *
     * @apiParam {Integer} event_id ID мероприятия
     * @apiParam {Json} request Обьект заявки
     */
    /**
     * @return Request|array
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
                $requestObject->status_id = 1;
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
     * @api {post} /v1/request/{id} Обновление статуса заявки
     * @apiName Update
     * @apiGroup Request
     * @apiVersion 1.0.0
     *
     * @apiParam {Integer} status_id ID статуса
     */
    /**
     * @param $id
     * @return Request|array
     * @throws HttpException
     */
    public function actionUpdate($id){
        $response = array();
        $requestObject = Request::findOne($id);
        $event = Event::findOne($requestObject->event_id);
        $organization = Organization::findOne($event->organization_id);
        if(($event->user_id == Yii::$app->user->identity['id']) || ($organization->user_id == Yii::$app->user->identity['id'])){
            try {
                $request = Yii::$app->getRequest()->getBodyParams();
                $requestObject->status_id = intval($request['status_id']);
                $requestObject->save();
                $response = $requestObject;
            } catch (InvalidConfigException $e) {
            }
        }else{
            throw new ForbiddenHttpException(sprintf('You can only update articles that you\'ve created.'));
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
        if ($action === 'delete') {
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