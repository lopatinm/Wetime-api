<?php

namespace app\modules\v1\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "user_attributes".
 *
 * @property int $id
 * @property int $internalKey
 * @property string|null $fullname
 * @property string|null $email
 * @property string|null $phone
 * @property int|null $locality_id
 * @property int|null $lastlogin
 * @property string|null $photo
 * @property string|null $messages
 * @property string|null $path
 *
 * @property User $internalKey0
 * @property Locality $locality
 */
class UserAttributes extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_attributes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['internalKey'], 'required'],
            [['internalKey', 'locality_id', 'lastlogin'], 'integer'],
            [['messages'], 'string'],
            [['fullname', 'email', 'phone', 'photo', 'path'], 'string', 'max' => 255],
            [['internalKey'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['internalKey' => 'id']],
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
            'internalKey' => 'Internal Key',
            'fullname' => 'Fullname',
            'email' => 'Email',
            'phone' => 'Phone',
            'locality_id' => 'Locality ID',
            'lastlogin' => 'Lastlogin',
            'photo' => 'Photo',
            'messages' => 'Messages',
            'path' => 'Path',
        ];
    }

    /**
     * @return array
     */
    public function fields()
    {
        return ['id', 'fullname', 'email', 'phone', 'locality', 'photo'];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInternalKey0()
    {
        return $this->hasOne(User::className(), ['id' => 'internalKey']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocality()
    {
        return $this->hasOne(Locality::className(), ['id' => 'locality_id']);
    }

    public static function findById($internalKey)
    {
        return static::findOne(['internalKey' => $internalKey]);
    }
}
