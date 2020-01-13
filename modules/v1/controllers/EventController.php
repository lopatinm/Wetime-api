<?php
namespace app\modules\v1\controllers;

use app\modules\v1\models\Calendar;
use app\modules\v1\models\Event;
use app\modules\v1\models\Organization;
use app\modules\v1\models\Request;
use app\modules\v1\models\Subscription;
use app\modules\v1\models\UserAttributes;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\Cors;
use yii\helpers\ArrayHelper;
use yii\rest\ActiveController;
use yii\web\ForbiddenHttpException;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;

class EventController extends ActiveController {

    public $modelClass = 'app\modules\v1\models\Event';
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
        $behaviors['authenticator']['only'] = ['create', 'update', 'delete', 'request', 'subscription'];

        return $behaviors;
    }

    public function actions(){
        $actions = parent::actions();
        unset($actions['index'], $actions['create'], $actions['update'], $actions['delete']);
        return $actions;
    }

    public function actionIndex(){
        $model = new Event;
        $activeData = new ActiveDataProvider([
            'query' => $model::find()->orderBy("id DESC"),
        ]);
        return $activeData;
    }

    /**
     * @api {post} /v1/event Создание мероприятия
     * @apiName Create
     * @apiGroup Event
     * @apiVersion 1.0.0
     * @apiPermission administrator
     * @apiHeader {String} Content-type MIME тип ресурса, например: application/json or application/xml.
     * @apiHeader {String} Authorization token авторизации.
     * @apiHeaderExample {String} Пример заголовка:
     *     "Content-type": "application/json"
     *     "Authorization": "Bearer BJHTN8rL9PfemW3Ws5shZK90jYh-RZ3QOXXDD9M3lXPe-GDE1pOPaHfN_JTxQprV"
     *
     * @apiParam {Integer} organization_id ID организации
     * @apiParam {Integer} locality_id ID населенного пункта
     * @apiParam {Integer} category_id ID категории
     * @apiParam {String} title Название мероприятия
     * @apiParam {String} [introtext] Краткое описание мероприятия
     * @apiParam {String} [description] Подробное описание мероприятия
     * @apiParam {String} [image] URL картинки мероприятия
     * @apiParam {String} [gallery] Список URL картинок мероприятия
     * @apiParam {String} [video] URL видео мероприятия
     * @apiParam {String} [address] Адрес места проведения мероприятия
     * @apiParam {String} [phone] Контактный телефон ответсвенного мероприятия
     * @apiParam {String} [email] Электронная почта ответсвенного мероприятия
     * @apiParam {String} [contact] ФИО ответсвенного мероприятия
     * @apiParam {Integer} published Статус публикации мероприятия
     * @apiParam {Unixtime} date Дата начала мероприятия
     * @apiParam {String} time Время начала мероприятия
     * @apiParam {String} [tags] Теги мероприятия
     * @apiParam {String} [latitude] Широта на карте места проведения мероприятия
     * @apiParam {String} [longitude] Долгота на карте места проведения мероприятия
     * @apiParam {json} [form] Форма заявки мероприятия
     */
    /**
     * @inheritdoc
     */
    public function actionCreate()
    {
        if(!isset(Yii::$app->authManager->getRolesByUser(Yii::$app->user->identity['id'])['root']))
            if(!isset(Yii::$app->authManager->getRolesByUser(Yii::$app->user->identity['id'])['administrator']))
                if(!isset(Yii::$app->authManager->getRolesByUser(Yii::$app->user->identity['id'])['manager']))
                    throw new ForbiddenHttpException(sprintf('You can only create articles that you\'ve created.'));

        $params = Yii::$app->getRequest()->getBodyParams();
        $params['user_id'] = Yii::$app->user->identity['id'];
        $event = new Event;
        $event->user_id =     $params['user_id'];
        $event->title =       $params['title'];
        $event->alias =       Event::translit($params['title']);
        $event->organization_id = $params['organization_id'];
        $event->category_id = $params['category_id'];
        $event->locality_id = $params['locality_id'];
        $event->createdon = time();
        $event->views = 0;
        $event->rating = 0;

        if(isset($params['introtext'])){
            $event->introtext = $params['introtext'];
        }
        if(isset($params['description'])) {
            $event->description = $params['description'];
        }
        if(isset($params['image'])) {
            $event->image = $params['image'];
        }
        if(isset($params['gallery'])) {
            $event->gallery = $params['gallery'];
        }
        if(isset($params['video'])) {
            $event->video = $params['video'];
        }
        if(isset($params['address'])) {
            $event->address = $params['address'];
        }
        if(isset($params['phone'])) {
            $event->phone = $params['phone'];
        }
        if(isset($params['email'])) {
            $event->email = $params['email'];
        }
        if(isset($params['contact'])) {
            $event->contact = $params['contact'];
        }
        if(isset($params['published'])) {
            $event->published = $params['published'];
        }
        if(isset($params['date'])) {
            $event->date = $params['date'];
        }
        if(isset($params['time'])) {
            $event->time = $params['time'];
        }
        if(isset($params['tags'])) {
            $event->tags = $params['tags'];
        }
        if(isset($params['latitude'])) {
            $event->latitude = $params['latitude'];
        }
        if(isset($params['longitude'])) {
            $event->longitude = $params['longitude'];
        }
        if(isset($params['form'])) {
            $event->form = $params['form'];
        }
        $event->save();

        $calendar = new Calendar;
        $calendar->event_id = $event->id;
        $calendar->date = $event->date;
        $calendar->save();

        return $event;
    }

    /**
     * @api {put} /v1/event/{id} Обновление мероприятия
     * @apiDescription Для обновления мероприятия нажно передать {id} - ID мероприятия в URL
     * @apiName Update
     * @apiGroup Event
     * @apiVersion 1.0.0
     * @apiPermission administrator
     * @apiHeader {String} Content-type MIME тип ресурса, например: application/json or application/xml.
     * @apiHeader {String} Authorization token авторизации.
     * @apiHeaderExample {String} Пример заголовка:
     *     "Content-type": "application/json"
     *     "Authorization": "Bearer BJHTN8rL9PfemW3Ws5shZK90jYh-RZ3QOXXDD9M3lXPe-GDE1pOPaHfN_JTxQprV"
     *
     * @apiParam {Integer} organization_id ID организации
     * @apiParam {Integer} locality_id ID населенного пункта
     * @apiParam {Integer} category_id ID категории
     * @apiParam {String} title Название мероприятия
     * @apiParam {String} [introtext] Краткое описание мероприятия
     * @apiParam {String} [description] Подробное описание мероприятия
     * @apiParam {String} [image] URL картинки мероприятия
     * @apiParam {String} [gallery] Список URL картинок мероприятия
     * @apiParam {String} [video] URL видео мероприятия
     * @apiParam {String} [address] Адрес места проведения мероприятия
     * @apiParam {String} [phone] Контактный телефон ответсвенного мероприятия
     * @apiParam {String} [email] Электронная почта ответсвенного мероприятия
     * @apiParam {String} [contact] ФИО ответсвенного мероприятия
     * @apiParam {Integer} published Статус публикации мероприятия
     * @apiParam {Unixtime} date Дата начала мероприятия
     * @apiParam {String} time Время начала мероприятия
     * @apiParam {String} [tags] Теги мероприятия
     * @apiParam {String} [latitude] Широта на карте места проведения мероприятия
     * @apiParam {String} [longitude] Долгота на карте места проведения мероприятия
     * @apiParam {json} [form] Форма заявки мероприятия
     */
    /**
     * @param $id
     * @return Event
     * @throws ForbiddenHttpException
     * @throws NotFoundHttpException
     * @throws \yii\base\InvalidConfigException
     */
    public function actionUpdate($id)
    {
        if(Event::findOne($id) != null){
            $event = Event::findOne($id);
            if(!isset(Yii::$app->authManager->getRolesByUser(Yii::$app->user->identity['id'])['root'])){
                if ($event->user_id !== Yii::$app->user->identity['id']){
                    throw new ForbiddenHttpException(sprintf('You can only update articles that you\'ve created.'));
                }
            }

            $params = Yii::$app->getRequest()->getBodyParams();
            $event->title =       $params['title'];
            $event->alias =       Event::translit($params['title']);
            $event->organization_id = $params['organization_id'];
            $event->category_id = $params['category_id'];
            $event->locality_id = $params['locality_id'];

            if(isset($params['introtext'])){
                $event->introtext = $params['introtext'];
            }
            if(isset($params['description'])) {
                $event->description = $params['description'];
            }
            if(isset($params['image'])) {
                $event->image = $params['image'];
            }
            if(isset($params['gallery'])) {
                $event->gallery = $params['gallery'];
            }
            if(isset($params['video'])) {
                $event->video = $params['video'];
            }
            if(isset($params['address'])) {
                $event->address = $params['address'];
            }
            if(isset($params['phone'])) {
                $event->phone = $params['phone'];
            }
            if(isset($params['email'])) {
                $event->email = $params['email'];
            }
            if(isset($params['contact'])) {
                $event->contact = $params['contact'];
            }
            if(isset($params['published'])) {
                $event->published = $params['published'];
            }
            if(isset($params['date'])) {
                $event->date = $params['date'];
            }
            if(isset($params['time'])) {
                $event->time = $params['time'];
            }
            if(isset($params['tags'])) {
                $event->tags = $params['tags'];
            }
            if(isset($params['latitude'])) {
                $event->latitude = $params['latitude'];
            }
            if(isset($params['longitude'])) {
                $event->longitude = $params['longitude'];
            }
            if(isset($params['form'])) {
                $event->form = $params['form'];
            }
            $event->save();
            return $event;
        }else{
            throw new NotFoundHttpException(sprintf('Event for ID '.$id.' not found'));
        }
    }

    /**
     * @api {delete} /v1/event/{id} Удаление мероприятия
     * @apiDescription Для удаления мероприятия нажно передать {id} - ID мероприятия в URL
     * @apiName Delete
     * @apiGroup Event
     * @apiVersion 1.0.0
     * @apiPermission administrator
     * @apiHeader {String} Content-type MIME тип ресурса, например: application/json or application/xml.
     * @apiHeader {String} Authorization token авторизации.
     * @apiHeaderExample {String} Пример заголовка:
     *     "Content-type": "application/json"
     *     "Authorization": "Bearer BJHTN8rL9PfemW3Ws5shZK90jYh-RZ3QOXXDD9M3lXPe-GDE1pOPaHfN_JTxQprV"
     */
    /**
     * @param $id
     * @throws ForbiddenHttpException
     * @throws NotFoundHttpException
     * @throws \Exception
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        if(Event::findOne($id) != null) {
            $event = Event::findOne($id);
            if (!empty($event->user_id))
                if ($event->user_id !== Yii::$app->user->identity['id'])
                    throw new ForbiddenHttpException(sprintf('You can only delete articles that you\'ve created.'));

            $requests = Request::find()->where(array('event_id' => $event->id))->count();
            $subscriptions = Subscription::find()->where(array('event_id' => $event->id))->count();
            if($requests > 0)
                throw new ForbiddenHttpException(sprintf('It is not possible to delete, there are dependencies: Requests.'));
            if($subscriptions > 0)
                throw new ForbiddenHttpException(sprintf('It is not possible to delete, there are dependencies: Subscriptions.'));
            $calendar = Calendar::find()->where(array('event_id'=>$event->id))->one();
            $calendar->delete();
            $event->delete();
            throw new HttpException(204, sprintf('Event for ID %s Remove', $id), 204);
        }else{
            throw new NotFoundHttpException(sprintf('Event for ID '.$id.' not found'));
        }
    }

    /**
     * @api {get} /v1/event/{id}/request Список заявок на мероприятие
     * @apiDescription Для получения списка заявок мероприятия нажно передать {id} - ID мероприятия в URL
     * @apiName Request
     * @apiGroup Event
     * @apiVersion 1.0.0
     * @apiPermission administrator
     * @apiHeader {String} Content-type MIME тип ресурса, например: application/json or application/xml.
     * @apiHeader {String} Authorization token авторизации.
     * @apiHeaderExample {String} Пример заголовка:
     *     "Content-type": "application/json"
     *     "Authorization": "Bearer BJHTN8rL9PfemW3Ws5shZK90jYh-RZ3QOXXDD9M3lXPe-GDE1pOPaHfN_JTxQprV"
     */
    /**
     * @param $id
     * @return array|\yii\db\ActiveRecord[]
     * @throws ForbiddenHttpException
     */
    public function actionRequest($id)
    {
        $event = Event::findOne($id);
        if (!empty($event->user_id))
            if ($event->user_id !== Yii::$app->user->identity['id'])
                throw new ForbiddenHttpException(sprintf('You can only request articles that you\'ve created.'));
        $requests = Request::find()->where(array('event_id' => $event->id))->all();
        return $requests;
    }

    /**
     * @api {get} /v1/event/{id}/subscription Список подписок на мероприятие
     * @apiDescription Для получения списка подписок мероприятия нажно передать {id} - ID мероприятия в URL
     * @apiName Subscription
     * @apiGroup Event
     * @apiVersion 1.0.0
     * @apiPermission administrator
     * @apiHeader {String} Content-type MIME тип ресурса, например: application/json or application/xml.
     * @apiHeader {String} Authorization token авторизации.
     * @apiHeaderExample {String} Пример заголовка:
     *     "Content-type": "application/json"
     *     "Authorization": "Bearer BJHTN8rL9PfemW3Ws5shZK90jYh-RZ3QOXXDD9M3lXPe-GDE1pOPaHfN_JTxQprV"
     */
    /**
     * @param $id
     * @return array
     * @throws ForbiddenHttpException
     */
    public function actionSubscription($id)
    {
        $event = Event::findOne($id);
        if (!empty($event->user_id))
            if ($event->user_id !== Yii::$app->user->identity['id'])
                throw new ForbiddenHttpException(sprintf('You can only request articles that you\'ve created.'));
        $subscriptions = array();
        $subscriptionCollection = Subscription::find()->where(array('event_id' => $event->id))->asArray()->all();
        foreach ($subscriptionCollection as $subscriptionObject) {
            $user = UserAttributes::find()->where(array("internalKey" => $subscriptionObject['user_id']))->asArray()->one();
            $subscriptions[] = array("fullname" => $user['fullname'], "photo" => $user['photo']);
        }
        return $subscriptions;
    }

    /**
     * @api {get} /v1/event/sort/{field}/{order} Сортировка списка мероприятий
     * @apiDescription Для сортировки списка мероприятий нажно передать {field} - Поле мероприятия в URL по которому будет сортировка, и {order} - порядок сортировки.
     * Возможные значения: {field} - rating|date|createdon, {order} - desc|asc.
     * @apiName Sort
     * @apiGroup Event
     * @apiVersion 1.0.0
     * @apiPermission none
     * @apiHeader {String} Content-type MIME тип ресурса, например: application/json or application/xml.
     * @apiHeaderExample {String} Пример заголовка:
     *     "Content-type": "application/json"
     */
    public function actionSort()
    {
        $url = explode('/', Yii::$app->request->pathInfo);
        $field = $url[3];
        $order = $url[4];
        $model = new Event;
        $activeData = new ActiveDataProvider([
            'query' => $model::find()->orderBy($field." ".$order),
        ]);
        return $activeData;
    }

    /**
     * @api {get} /v1/event/filter/{organization|locality|category}/{id}  Фильтрация списка мероприятий
     * @apiName Filter
     * @apiGroup Event
     * @apiVersion 1.0.0
     * @apiPermission none
     * @apiHeader {String = application/json, application/xml} Content-type=application/json MIME тип ресурса.
     * @apiHeaderExample {String} Пример заголовка:
     *     "Content-type": "application/json"
     */
    /**
     * @param $id
     * @return ActiveDataProvider
     */
    public function actionFilter($id)
    {
        $url = explode('/', Yii::$app->request->pathInfo);
        $field = $url[3];
        $model = new Event;
        $activeData = new ActiveDataProvider([
            'query' => $model::find()->where(array($field.'_id' => $id))->orderBy("id DESC"),
        ]);
        return $activeData;
    }
}