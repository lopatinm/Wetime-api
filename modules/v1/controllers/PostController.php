<?php
namespace app\modules\v1\controllers;

use app\modules\v1\models\Event;
use app\modules\v1\models\Organization;
use app\modules\v1\models\Post;
use app\modules\v1\models\Subscription;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\Cors;
use yii\helpers\ArrayHelper;
use yii\rest\ActiveController;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;

class PostController extends ActiveController {

    public $modelClass = 'app\modules\v1\models\Post';
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
        $behaviors['authenticator']['only'] = ['create', 'update', 'delete', 'index'];


        return $behaviors;
    }

    public function actions(){
        $actions = parent::actions();
        unset($actions['index'], $actions['create']);
        return $actions;
    }

    /**
     * @api {get} /v1/post Список публикаций по подпискам
     * @apiName Post
     * @apiGroup Post
     * @apiVersion 1.0.0
     * @apiPermission administrator, manager, user
     * @apiHeader {String = application/json, application/xml} Content-type MIME тип ресурса.
     * @apiHeader {String} Authorization token авторизации.
     * @apiHeaderExample {String} Пример заголовка:
     *     "Content-type": "application/json"
     *     "Authorization": "Bearer BJHTN8rL9PfemW3Ws5shZK90jYh-RZ3QOXXDD9M3lXPe-GDE1pOPaHfN_JTxQprV"
     */
    public function actionIndex(){
        $model = new Post;
        $events = Subscription::getEventIdsByUserId(Yii::$app->user->identity['id']);
        $activeData = new ActiveDataProvider([
            'query' => $model::find()->where(['event_id' => $events])->orderBy("id DESC"),
        ]);
        return $activeData;
    }

    /**
     * @api {post} /v1/post Создание публикации
     * @apiName Create
     * @apiGroup Post
     * @apiVersion 1.0.0
     * @apiPermission administrator, manager
     * @apiHeader {String = application/json, application/xml} Content-type MIME тип ресурса.
     * @apiHeader {String} Authorization token авторизации.
     * @apiHeaderExample {String} Пример заголовка:
     *     "Content-type": "application/json"
     *     "Authorization": "Bearer BJHTN8rL9PfemW3Ws5shZK90jYh-RZ3QOXXDD9M3lXPe-GDE1pOPaHfN_JTxQprV"
     *
     * @apiParam {Integer} event_id ID мероприятия
     * @apiParam {String} title Название публикации
     * @apiParam {String} content Текст публикации
     * @apiParam {String} [images] URL картинки публикации
     * @apiParam {String} [video] URL видео публикации
     */
    /**
     * @throws ForbiddenHttpException
     * @throws \yii\base\InvalidConfigException
     */
    public function actionCreate(){
        if(!isset(Yii::$app->authManager->getRolesByUser(Yii::$app->user->identity['id'])['root']))
            if(!isset(Yii::$app->authManager->getRolesByUser(Yii::$app->user->identity['id'])['administrator']))
                if(!isset(Yii::$app->authManager->getRolesByUser(Yii::$app->user->identity['id'])['manager']))
                    throw new ForbiddenHttpException(sprintf('You can only create articles that you\'ve created.'));

        $params = Yii::$app->getRequest()->getBodyParams();
        $post = new Post;
        $post->user_id = Yii::$app->user->identity['id'];
        $post->event_id = $params['event_id'];
        $post->title = $params['title'];
        $post->alias = Post::translit($params['title']);
        $post->createdon = time();

        if(isset($params['content'])){
            $post->content = $params['content'];
        }
        if(isset($params['images'])){
            $post->images = $params['images'];
        }
        if(isset($params['video'])){
            $post->video = $params['video'];
        }
        $post->save();
        return $post;
    }


    /**
     * @api {put} /v1/post Обновление публикации
     * @apiName Update
     * @apiGroup Post
     * @apiVersion 1.0.0
     * @apiPermission administrator, manager
     * @apiHeader {String = application/json, application/xml} Content-type MIME тип ресурса.
     * @apiHeader {String} Authorization token авторизации.
     * @apiHeaderExample {String} Пример заголовка:
     *     "Content-type": "application/json"
     *     "Authorization": "Bearer BJHTN8rL9PfemW3Ws5shZK90jYh-RZ3QOXXDD9M3lXPe-GDE1pOPaHfN_JTxQprV"
     *
     * @apiParam {Integer} event_id ID мероприятия
     * @apiParam {String} title Название публикации
     * @apiParam {String} content Текст публикации
     * @apiParam {String} [images] URL картинки публикации
     * @apiParam {String} [video] URL видео публикации
     */
    /**
     * @param $id
     * @return Post
     * @throws ForbiddenHttpException
     * @throws NotFoundHttpException
     * @throws \yii\base\InvalidConfigException
     */
    public function actionUpdate($id){
        if(Post::findOne($id) != null) {
            $post = Post::findOne($id);
            if(!isset(Yii::$app->authManager->getRolesByUser(Yii::$app->user->identity['id'])['root'])){
                if ($post->user_id !== Yii::$app->user->identity['id']){
                    throw new ForbiddenHttpException(sprintf('You can only update articles that you\'ve created.'));
                }
            }

            $params = Yii::$app->getRequest()->getBodyParams();

            if(isset($params['title'])) {
                $post->title = $params['title'];
                $post->alias = Post::translit($params['title']);
            }
            if(isset($params['content'])){
                $post->content = $params['content'];
            }
            if(isset($params['images'])){
                $post->images = $params['images'];
            }
            if(isset($params['video'])){
                $post->video = $params['video'];
            }
            $post->save();

            return $post;
        }else{
            throw new NotFoundHttpException(sprintf('Post for ID '.$id.' not found'));
        }
    }

    /**
     * @api {delete} /v1/post/{id} Удаление публикации
     * @apiDescription {id} - ID публикации в URL
     * @apiName Delete
     * @apiGroup Post
     * @apiVersion 1.0.0
     * @apiPermission administrator, manager
     * @apiHeader {String = application/json, application/xml} Content-type MIME тип ресурса.
     * @apiHeader {String} Authorization token авторизации.
     * @apiHeaderExample {String} Пример заголовка:
     *     "Content-type": "application/json"
     *     "Authorization": "Bearer BJHTN8rL9PfemW3Ws5shZK90jYh-RZ3QOXXDD9M3lXPe-GDE1pOPaHfN_JTxQprV"
     */
    /**
     * @param $id
     * @throws \Exception
     * @throws \Throwable
     */
    public function actionDelete($id)
    {

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