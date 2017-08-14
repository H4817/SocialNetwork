<?php

namespace common\models\database;

class Message extends BaseMessage
{
    public function rules()
    {
        return [
            [['message'], 'required'],
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->date = date('Y-m-d H:i:s', time());
            return true;
        }
        return false;
    }


    public function load($data, $formName = null)
    {
        parent::load($data);
        $this->senderId = $data[0];
        $this->receiverId = $data[1];
        $this->message = $data[2];
        $this->save();
        $this->message = '';
    }

    public static function findChatMessages($userId, $anotherUserId)
    {
        return Message::find()->where(['and', ['senderId' => $userId], ['receiverId' => $anotherUserId]])
            ->orWhere(['and', ['senderId' => $anotherUserId], ['receiverId' => $userId]])
            ->orderBy('messageId');
    }
}
