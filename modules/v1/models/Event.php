<?php

namespace app\modules\v1\models;

use Yii;

/**
 * This is the model class for table "event".
 *
 * @property int $id
 * @property int $user_id
 * @property int $organization_id
 * @property int $locality_id
 * @property int $category_id
 * @property string $title
 * @property string|null $alias
 * @property string|null $introtext
 * @property string|null $description
 * @property string|null $image
 * @property string|null $gallery
 * @property string|null $video
 * @property string|null $address
 * @property string|null $phone
 * @property string|null $email
 * @property string|null $contact
 * @property int|null $createdon
 * @property int $published
 * @property int|null $date
 * @property string|null $time
 * @property string|null $tags
 * @property int $rating
 * @property int $views
 * @property string|null $latitude
 * @property string|null $longitude
 * @property string|null $form
 *
 * @property Calendar[] $calendars
 * @property User $user
 * @property Organization $organization
 * @property Locality $locality
 * @property Category $category
 * @property Post[] $posts
 * @property Request[] $requests
 * @property Subscription[] $subscriptions
 */
class Event extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'event';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'organization_id', 'locality_id', 'category_id', 'title'], 'required'],
            [['user_id', 'organization_id', 'locality_id', 'category_id', 'createdon', 'published', 'date', 'rating', 'views'], 'integer'],
            [['introtext', 'description', 'gallery', 'tags', 'form'], 'string'],
            [['title', 'alias', 'image', 'video', 'address', 'phone', 'email', 'contact', 'time'], 'string', 'max' => 255],
            [['latitude', 'longitude'], 'string', 'max' => 20],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['organization_id'], 'exist', 'skipOnError' => true, 'targetClass' => Organization::className(), 'targetAttribute' => ['organization_id' => 'id']],
            [['locality_id'], 'exist', 'skipOnError' => true, 'targetClass' => Locality::className(), 'targetAttribute' => ['locality_id' => 'id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'organization_id' => 'Organization ID',
            'locality_id' => 'Locality ID',
            'category_id' => 'Category ID',
            'title' => 'Title',
            'alias' => 'Alias',
            'introtext' => 'Introtext',
            'description' => 'Description',
            'image' => 'Image',
            'gallery' => 'Gallery',
            'video' => 'Video',
            'address' => 'Address',
            'phone' => 'Phone',
            'email' => 'Email',
            'contact' => 'Contact',
            'createdon' => 'Createdon',
            'published' => 'Published',
            'date' => 'Date',
            'time' => 'Time',
            'tags' => 'Tags',
            'rating' => 'Rating',
            'views' => 'Views',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'form' => 'Form',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCalendars()
    {
        return $this->hasMany(Calendar::className(), ['event_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganization()
    {
        return $this->hasOne(Organization::className(), ['id' => 'organization_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocality()
    {
        return $this->hasOne(Locality::className(), ['id' => 'locality_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['event_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequests()
    {
        return $this->hasMany(Request::className(), ['event_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubscriptions()
    {
        return $this->hasMany(Subscription::className(), ['event_id' => 'id']);
    }

    public static function translit($text){
        $s = (string) $text;
        $s = strip_tags($s);
        $s = str_replace(array("\n", "\r"), " ", $s);
        $s = preg_replace("/\s+/", ' ', $s);
        $s = trim($s);
        $s = function_exists('mb_strtolower') ? mb_strtolower($s) : strtolower($s);
        $s = strtr($s, array('а'=>'a','б'=>'b','в'=>'v','г'=>'g','д'=>'d','е'=>'e','ё'=>'e','ж'=>'j','з'=>'z','и'=>'i','й'=>'y','к'=>'k','л'=>'l','м'=>'m','н'=>'n','о'=>'o','п'=>'p','р'=>'r','с'=>'s','т'=>'t','у'=>'u','ф'=>'f','х'=>'h','ц'=>'c','ч'=>'ch','ш'=>'sh','щ'=>'sh','ы'=>'y','э'=>'e','ю'=>'yu','я'=>'ya','ъ'=>'','ь'=>''));
        $s = preg_replace("/[^0-9a-z-_ ]/i", "", $s);
        $s = str_replace(" ", "-", $s);
        return $s;
    }
}
