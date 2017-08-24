<?php

namespace common\models\database;

use Yii;

/**
 * This is the model class for table "message".
 *
 * @property integer $messageId
 * @property integer $senderId
 * @property integer $receiverId
 * @property string $message
 * @property string $date
 *
 * @property User $receiver
 * @property User $sender
 */
class BaseMessage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'message';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['senderId', 'receiverId'], 'integer'],
            [['date'], 'safe'],
            [['message'], 'string', 'max' => 255],
            [['receiverId'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['receiverId' => 'userId']],
            [['senderId'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['senderId' => 'userId']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'messageId' => 'Message ID',
            'senderId' => 'Sender ID',
            'receiverId' => 'Receiver ID',
            'message' => 'Message',
            'date' => 'Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReceiver()
    {
        return $this->hasOne(User::className(), ['userId' => 'receiverId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSender()
    {
        return $this->hasOne(User::className(), ['userId' => 'senderId']);
    }
}
