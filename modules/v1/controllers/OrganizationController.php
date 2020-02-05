<?php
namespace app\modules\v1\controllers;

use app\modules\v1\models\Event;
use app\modules\v1\models\Organization;
use Yii;
use yii\base\InvalidConfigException;
use yii\data\ActiveDataProvider;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\Cors;
use yii\helpers\ArrayHelper;
use yii\rest\ActiveController;
use yii\web\ForbiddenHttpException;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;

class OrganizationController extends ActiveController {

    public $modelClass = 'app\modules\v1\models\Organization';
    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];

    public function behaviors()
    {
        $behaviors = ArrayHelper::merge(parent::behaviors(), [
            'corsFilter' => [
                'class' => Cors::className(),
            ],
        ]);
        $behaviors['authenticator']['class'] = HttpBearerAuth::className();
        $behaviors['authenticator']['only'] = ['create', 'update', 'delete'];


        return $behaviors;
    }

    public function actions(){
        $actions = parent::actions();
        unset($actions['index'], $actions['create'], $actions['update'], $actions['delete']);
        return $actions;
    }

    /**
     * @api {get} /v1/organization Получение списка организация
     * @apiName Organization
     * @apiGroup Organization
     * @apiVersion 1.0.0
     * @apiHeader {String = application/json, application/xml} Content-type MIME тип ресурса.
     * @apiHeaderExample {String} Пример заголовка:
     *     "Content-type": "application/json"
     */
    public function actionIndex(){
        $model = new Organization;
        $activeData = new ActiveDataProvider([
            'query' => $model::find()->orderBy("id DESC"),
        ]);
        return $activeData;
    }

    /**
     * @api {post} /v1/organization Создание организации
     * @apiName Create
     * @apiGroup Organization
     * @apiVersion 1.0.0
     * @apiPermission administrator
     * @apiHeader {String = application/json, application/xml} Content-type MIME тип ресурса.
     * @apiHeader {String} Authorization token авторизации.
     * @apiHeaderExample {String} Пример заголовка:
     *     "Content-type": "application/json"
     *     "Authorization": "Bearer BJHTN8rL9PfemW3Ws5shZK90jYh-RZ3QOXXDD9M3lXPe-GDE1pOPaHfN_JTxQprV"
     *
     * @apiParam {String} name Название организации
     * @apiParam {String} longname Полное название организации
     * @apiParam {String} introtext Краткое описание организации
     * @apiParam {String} description Полное описание организации
     * @apiParam {String} image URL логотипа организации
     * @apiParam {Integer} locality_id ID населенного пункта
     * @apiParam {String} address Адрес организации
     * @apiParam {String} phone Номер телефона организации
     * @apiParam {String} email Электронная почта организации
     * @apiParam {String} latitude Широта на карте места организации
     * @apiParam {String} longitude Долгота на карте места организации
     * @apiParam {Integer} published Статус публикации организации
     */
    /**
     * @return Organization
     * @throws ForbiddenHttpException
     * @throws InvalidConfigException
     */
    public function actionCreate()
    {
        if(!isset(Yii::$app->authManager->getRolesByUser(Yii::$app->user->identity['id'])['root']))
            if(!isset(Yii::$app->authManager->getRolesByUser(Yii::$app->user->identity['id'])['administrator']))
                throw new ForbiddenHttpException(sprintf('You can only create articles that you\'ve created.'));

        $params = Yii::$app->getRequest()->getBodyParams();
        $params['user_id'] = Yii::$app->user->identity['id'];
        $organization = new Organization;
        $organization->user_id =     $params['user_id'];
        $organization->name =        $params['name'];
        $organization->email =       $params['email'];
        $organization->alias =       Organization::translit($params['name']);

        if(isset($params['longname'])){
            $organization->longname = $params['longname'];
        }
        if(isset($params['introtext'])) {
            $organization->introtext = $params['introtext'];
        }
        if(isset($params['description'])) {
            $organization->description = $params['description'];
        }
        if(isset($params['image'])) {
            $organization->image = $params['image'];
        }
        if(isset($params['locality_id'])) {
            $organization->locality_id = $params['locality_id'];
        }
        if(isset($params['address'])) {
            $organization->address = $params['address'];
        }
        if(isset($params['phone'])) {
            $organization->phone = $params['phone'];
        }
        if(isset($params['latitude'])) {
            $organization->latitude = $params['latitude'];
        }
        if(isset($params['longitude'])) {
            $organization->longitude = $params['longitude'];
        }
        if(isset($params['published'])) {
            $organization->published = $params['published'];
        }
        $organization->save();
        return $organization;
    }

    /**
     * @api {put} /v1/organization/{id} Обновление организации
     * @apiDescription {id} - ID организации
     * @apiName Update
     * @apiGroup Organization
     * @apiVersion 1.0.0
     * @apiPermission administrator
     * @apiHeader {String = application/json, application/xml} Content-type MIME тип ресурса.
     * @apiHeader {String} Authorization token авторизации.
     * @apiHeaderExample {String} Пример заголовка:
     *     "Content-type": "application/json"
     *     "Authorization": "Bearer BJHTN8rL9PfemW3Ws5shZK90jYh-RZ3QOXXDD9M3lXPe-GDE1pOPaHfN_JTxQprV"
     *
     * @apiParam {String} name Название организации
     * @apiParam {String} longname Полное название организации
     * @apiParam {String} introtext Краткое описание организации
     * @apiParam {String} description Полное описание организации
     * @apiParam {String} image URL логотипа организации
     * @apiParam {Integer} locality_id ID населенного пункта
     * @apiParam {String} address Адрес организации
     * @apiParam {String} phone Номер телефона организации
     * @apiParam {String} email Электронная почта организации
     * @apiParam {String} latitude Широта на карте места организации
     * @apiParam {String} longitude Долгота на карте места организации
     * @apiParam {Integer} published Статус публикации организации
     */
    /**
     * @param $id
     * @return Organization
     * @throws ForbiddenHttpException
     * @throws InvalidConfigException
     */
    public function actionUpdate($id)
    {
        $organization = Organization::findOne($id);
        if(!isset(Yii::$app->authManager->getRolesByUser(Yii::$app->user->identity['id'])['root'])){
            if ($organization->user_id !== Yii::$app->user->identity['id']){
                throw new ForbiddenHttpException(sprintf('You can only update articles that you\'ve created.'));
            }
        }

        $params = Yii::$app->getRequest()->getBodyParams();

        $organization->name =        $params['name'];
        $organization->email =       $params['email'];
        $organization->alias =       Organization::translit($params['name']);

        if(isset($params['longname'])){
            $organization->longname = $params['longname'];
        }
        if(isset($params['introtext'])) {
            $organization->introtext = $params['introtext'];
        }
        if(isset($params['description'])) {
            $organization->description = $params['description'];
        }
        if(isset($params['image'])) {
            $organization->image = $params['image'];
        }
        if(isset($params['locality_id'])) {
            $organization->locality_id = $params['locality_id'];
        }
        if(isset($params['address'])) {
            $organization->address = $params['address'];
        }
        if(isset($params['phone'])) {
            $organization->phone = $params['phone'];
        }
        if(isset($params['latitude'])) {
            $organization->latitude = $params['latitude'];
        }
        if(isset($params['longitude'])) {
            $organization->longitude = $params['longitude'];
        }
        if(isset($params['published'])) {
            $organization->published = $params['published'];
        }
        $organization->save();
        return $organization;
    }

    /**
     * @api {delete} /v1/organization/{id} Удаление организации
     * @apiDescription {id} - ID организации
     * @apiName Delete
     * @apiGroup Organization
     * @apiVersion 1.0.0
     * @apiPermission administrator
     * @apiHeader {String = application/json, application/xml} Content-type MIME тип ресурса.
     * @apiHeader {String} Authorization token авторизации.
     * @apiHeaderExample {String} Пример заголовка:
     *     "Content-type": "application/json"
     *     "Authorization": "Bearer BJHTN8rL9PfemW3Ws5shZK90jYh-RZ3QOXXDD9M3lXPe-GDE1pOPaHfN_JTxQprV"
     */
    /**
     * @param $id
     * @throws ForbiddenHttpException
     * @throws \Exception
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        if(Organization::findOne($id) != null) {
            $organization = Organization::findOne($id);
            if (!empty($organization->user_id))
                if ($organization->user_id !== Yii::$app->user->identity['id'])
                    throw new ForbiddenHttpException(sprintf('You can only delete articles that you\'ve created.'));

            $events = Event::find()->where(array('organization_id' => $organization->id))->count();

            if($events > 0)
                throw new ForbiddenHttpException(sprintf('It is not possible to delete, there are dependencies: Event.'));
            $organization->delete();
            throw new HttpException(204, sprintf('Organization for ID %s Remove', $id), 204);
        }else{
            throw new NotFoundHttpException(sprintf('Organization for ID '.$id.' not found'));
        }
    }

    /**
     * @api {get} /v1/organization/{id}/event Список мероприятий организации
     * @apiDescription {id} - ID организации в URL
     * @apiName Event
     * @apiGroup Organization
     * @apiVersion 1.0.0
     * @apiHeader {String = application/json, application/xml} Content-type MIME тип ресурса.
     * @apiHeaderExample {String} Пример заголовка:
     *     "Content-type": "application/json"
     */
    /**
     * @param $id
     * @return ActiveDataProvider
     */
    public function actionEvent($id)
    {
        $model = new Event;
        $activeData = new ActiveDataProvider([
            'query' => $model::find()->where(array('organization_id' => $id))->orderBy("id DESC"),
        ]);
        return $activeData;
    }
}