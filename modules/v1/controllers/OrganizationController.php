<?php
namespace app\modules\v1\controllers;

use app\modules\v1\models\Organization;
use Yii;
use yii\base\InvalidConfigException;
use yii\data\ActiveDataProvider;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\Cors;
use yii\helpers\ArrayHelper;
use yii\rest\ActiveController;
use yii\web\ForbiddenHttpException;

class OrganizationController extends ActiveController {

    public $modelClass = 'app\modules\v1\models\Organization';

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
        $model = new Organization;
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
                throw new ForbiddenHttpException(sprintf('You can only create articles that you\'ve created.'));

        $params = (array)json_decode(Yii::$app->getRequest()->getRawBody());
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