<?php

namespace app\modules\v1\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "organization".
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string|null $longname
 * @property string|null $introtext
 * @property string|null $description
 * @property string $alias
 * @property string|null $image
 * @property int $locality_id
 * @property string|null $address
 * @property string|null $phone
 * @property string|null $email
 * @property string|null $latitude
 * @property string|null $longitude
 * @property int $published
 * @property string|null $access
 *
 * @property Event[] $events
 * @property User $user
 * @property Locality $locality
 */
class Organization extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'organization';
    }

    public static function traslit($alias)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'name', 'alias', 'locality_id', 'email'], 'required'],
            [['user_id', 'locality_id', 'published'], 'integer'],
            [['introtext', 'description', 'access'], 'string'],
            [['name', 'longname', 'alias', 'image', 'address', 'phone', 'email'], 'string', 'max' => 255],
            [['latitude', 'longitude'], 'string', 'max' => 20],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['locality_id'], 'exist', 'skipOnError' => true, 'targetClass' => Locality::className(), 'targetAttribute' => ['locality_id' => 'id']],
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
            'name' => 'Name',
            'longname' => 'Longname',
            'introtext' => 'Introtext',
            'description' => 'Description',
            'alias' => 'Alias',
            'image' => 'Image',
            'locality_id' => 'Locality ID',
            'address' => 'Address',
            'phone' => 'Phone',
            'email' => 'Email',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'published' => 'Published',
            'access' => 'Access',
        ];
    }

    /**
     * @return array
     */
    public function fields()
    {
        return [
            'id',
            'name',
            'longname',
            'introtext',
            'description',
            'alias',
            'image',
            'locality_id',
            'address',
            'phone',
            'email',
            'latitude',
            'longitude',
            'published'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvents()
    {
        return $this->hasMany(Event::className(), ['organization_id' => 'id']);
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
    public function getLocality()
    {
        return $this->hasOne(Locality::className(), ['id' => 'locality_id']);
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
