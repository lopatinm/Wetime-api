<?php
namespace app\modules\v1\controllers;

use app\modules\v1\models\Subscription;
use Yii;
use yii\web\HttpException;
use yii\base\InvalidConfigException;
use yii\data\ActiveDataProvider;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\Cors;
use yii\helpers\ArrayHelper;
use yii\rest\ActiveController;
use yii\web\ForbiddenHttpException;

class SubscriptionController extends ActiveController {

    public $modelClass = 'app\modules\v1\models\Subscription';

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
     * @api {get} /v1/subscription Список подписок
     * @apiName Index
     * @apiGroup Subscription
     * @apiVersion 1.0.0
     *
     * @apiHeader {String = application/json, application/xml} Content-type MIME тип ресурса.
     * @apiHeader {String} Authorization token авторизации.
     * @apiHeaderExample {String} Пример заголовка:
     *     "Content-type": "application/json"
     *     "Authorization": "Bearer BJHTN8rL9PfemW3Ws5shZK90jYh-RZ3QOXXDD9M3lXPe-GDE1pOPaHfN_JTxQprV"
     *
     */
    /**
     * @return ActiveDataProvider
     */
    public function actionIndex(){
        $model = new Subscription;
        $activeData = new ActiveDataProvider([
            'query' => $model::find()->where(array('user_id' => Yii::$app->user->identity['id']))->orderBy("id DESC"),
        ]);
        return $activeData;
    }

    /**
     * @api {post} /v1/subscription Создание подписки
     * @apiName Create
     * @apiGroup Subscription
     * @apiVersion 1.0.0
     * @apiHeader {String = application/json, application/xml} Content-type MIME тип ресурса.
     * @apiHeader {String} Authorization token авторизации.
     * @apiHeaderExample {String} Пример заголовка:
     *     "Content-type": "application/json"
     *     "Authorization": "Bearer BJHTN8rL9PfemW3Ws5shZK90jYh-RZ3QOXXDD9M3lXPe-GDE1pOPaHfN_JTxQprV"
     *
     * @apiParam {Integer} event_id ID мероприятия
     */
    /**
     * @return Subscription
     * @throws HttpException
     */
    public function actionCreate(){
        $response = array();
        try {
            $request = Yii::$app->getRequest()->getBodyParams();
            if(Subscription::isSubscription(Yii::$app->user->identity['id'], $request['event_id'])){
                $subscription = new Subscription;
                $subscription->user_id = Yii::$app->user->identity['id'];
                $subscription->event_id = intval($request['event_id']);
                $subscription->createdon = time();
                $subscription->save();
                $response = $subscription;
            }else{
                throw new HttpException(500, sprintf('Object already exist'), 485);
            }

        } catch (InvalidConfigException $e) {
        }
        return $response;
    }

    /**
     * @api {delete} /v1/subscription/{id} Удаление подписки
     * @apiDescription {id} - ID подписки
     * @apiName Delete
     * @apiGroup Subscription
     * @apiVersion 1.0.0
     * @apiHeader {String = application/json, application/xml} Content-type MIME тип ресурса.
     * @apiHeader {String} Authorization token авторизации.
     * @apiHeaderExample {String} Пример заголовка:
     *     "Content-type": "application/json"
     *     "Authorization": "Bearer BJHTN8rL9PfemW3Ws5shZK90jYh-RZ3QOXXDD9M3lXPe-GDE1pOPaHfN_JTxQprV"
     */
    public function actionDelete(){

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