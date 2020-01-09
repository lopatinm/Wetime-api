<?php

namespace app\modules\v1\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Json;

/**
 * This is the model class for table "request".
 *
 * @property int $id
 * @property int $user_id
 * @property int $event_id
 * @property int $createdon
 * @property json $request
 *
 * @property User $user
 * @property Event $event
 */
class Request extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'request';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'event_id', 'createdon', 'request'], 'required'],
            [['user_id', 'event_id', 'createdon'], 'integer'],
            [['request'], 'json'],
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
            'createdon' => 'Createdon',
            'request' => 'Request',
        ];
    }

    /**
     * @return array
     */
    public function fields()
    {
        return [
            'id',
            'event_id',
            'createdon',
            'request'
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

    public static function getRequestsByUserId($user_id){
        $events = array();
        $requests = Request::find()->where(array('user_id' => $user_id))->with(['event'])->asArray()->all();
        foreach ($requests as $request) {
            unset($request['event']['user_id']);
            $events[] = $request['event'];
        }
        return $events;
    }

    public static function isRequest($user_id, $event_id){
        if(Request::find()->where(array('user_id' => $user_id, 'event_id' => $event_id))->count() > 0){
            return false;
        }else{
            return true;
        }
    }
}
