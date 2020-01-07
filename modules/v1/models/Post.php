<?php

namespace app\modules\v1\models;

use Yii;

/**
 * This is the model class for table "post".
 *
 * @property int $id
 * @property int $user_id
 * @property int $event_id
 * @property string $title
 * @property string $alias
 * @property string|null $content
 * @property string|null $images
 * @property string|null $video
 * @property int $createdon
 *
 * @property User $user
 * @property Event $event
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'event_id', 'title', 'alias', 'createdon'], 'required'],
            [['user_id', 'event_id', 'createdon'], 'integer'],
            [['content', 'images'], 'string'],
            [['title', 'alias', 'video'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['event_id'], 'exist', 'skipOnError' => true, 'targetClass' => Event::className(), 'targetAttribute' => ['event_id' => 'id']],
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
            'event_id' => 'Event ID',
            'title' => 'Title',
            'alias' => 'Alias',
            'content' => 'Content',
            'images' => 'Images',
            'video' => 'Video',
            'createdon' => 'Createdon',
        ];
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
    public function getEvent()
    {
        return $this->hasOne(Event::className(), ['id' => 'event_id']);
    }
}
