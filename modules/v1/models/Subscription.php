<?php

namespace app\modules\v1\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "subscription".
 *
 * @property int $id
 * @property int $event_id
 * @property int $user_id
 * @property int $createdon
 *
 * @property Event $event
 * @property User $user
 */
class Subscription extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'subscription';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['event_id', 'user_id', 'createdon'], 'required'],
            [['event_id', 'user_id', 'createdon'], 'integer'],
            [['event_id'], 'exist', 'skipOnError' => true, 'targetClass' => Event::className(), 'targetAttribute' => ['event_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'event_id' => 'Event ID',
            'user_id' => 'User ID',
            'createdon' => 'Createdon',
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
            'createdon'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvent()
    {
        return $this->hasOne(Event::className(), ['id' => 'event_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public static function getSubscriptionsByUserId($user_id){
        $events = array();
        $subscriptions = Subscription::find()->where(array('user_id' => $user_id))->with(['event'])->asArray()->all();
        foreach ($subscriptions as $subscription) {
            unset($subscription['event']['user_id']);
            $event = $subscription['event'];
            $event['form'] = json_decode($event['form']);
            $events[] = $event;
        }
        return $events;
    }

    public static function getEventIdsByUserId($user_id){
        $events = array();
        $subscriptions = Subscription::find()->where(array('user_id' => $user_id))->with(['event'])->asArray()->all();
        foreach ($subscriptions as $subscription) {
            unset($subscription['event']['user_id']);
            $event = $subscription['event'];
            $events[] = $event['id'];
        }
        return $events;
    }

    public static function isSubscription($user_id, $event_id){
        if(Subscription::find()->where(array('user_id' => $user_id, 'event_id' => $event_id))->count() > 0){
            return false;
        }else{
            return true;
        }
    }
}
