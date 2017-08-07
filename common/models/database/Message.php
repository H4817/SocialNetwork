<?php
namespace common\models\database;

use Yii;

class Message extends BaseMessage
{
    public function load($data, $formName = null)
    {
        $this->senderId = $data[0];
        $this->receiverId = $data[1];
        $this->message = $data[2];
        $this->date = date('Y-m-d H:i:s', time());
        $this->save();
        $this->message = '';
    }
}
