<?php
namespace app\modules\v1\controllers;

use app\modules\v1\models\Event;
use app\modules\v1\models\Organization;
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
        $behaviors['authenticator']['only'] = ['create', 'update', 'delete'];


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
        if(isset($params['rating'])) {
            $event->rating = $params['rating'];
        }
        if(isset($params['views'])) {
            $event->views = $params['views'];
        }
        if(isset($params['latitude'])) {
            $event->latitude = $params['latitude'];
        }
        if(isset($params['longitude'])) {
            $event->longitude = $params['longitude'];
        }
        if(isset($params['published'])) {
            $event->published = $params['published'];
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
    public function actionUpdate($id)
    {
        $organization = Organization::findOne($id);
        if(!isset(Yii::$app->authManager->getRolesByUser(Yii::$app->user->identity['id'])['root'])){
            if ($organization->user_id !== Yii::$app->user->identity['id']){
                throw new ForbiddenHttpException(sprintf('You can only update articles that you\'ve created.'));
            }
        }

        $params = (array)json_decode(Yii::$app->getRequest()->getRawBody());

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