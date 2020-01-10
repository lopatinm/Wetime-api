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

class EventController extends ActiveController {

    public $modelClass = 'app\modules\v1\models\Event';

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
        unset($actions['index'], $actions['create'], $actions['update']);
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
     * @inheritdoc
     */
    public function actionCreate()
    {
        if(!isset(Yii::$app->authManager->getRolesByUser(Yii::$app->user->identity['id'])['root']))
            if(!isset(Yii::$app->authManager->getRolesByUser(Yii::$app->user->identity['id'])['administrator']))
                if(!isset(Yii::$app->authManager->getRolesByUser(Yii::$app->user->identity['id'])['manager']))
                    throw new ForbiddenHttpException(sprintf('You can only create articles that you\'ve created.'));

        $params = (array)json_decode(Yii::$app->getRequest()->getRawBody());
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
     * @inheritdoc
     */
    public function actionUpdate($id)
    {
        $event = Event::findOne($id);
        if(!isset(Yii::$app->authManager->getRolesByUser(Yii::$app->user->identity['id'])['root'])){
            if ($event->user_id !== Yii::$app->user->identity['id']){
                throw new ForbiddenHttpException(sprintf('You can only update articles that you\'ve created.'));
            }
        }

        $params = (array)json_decode(Yii::$app->getRequest()->getRawBody());
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
    }

    /**
     * @inheritdoc
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
     * @inheritdoc
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
        }
    }
}