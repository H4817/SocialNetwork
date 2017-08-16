<?php

namespace common\models\database;

class Comment extends BaseComment
{
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->date = date('Y-m-d H:i:s', time());
            $this->userId = \Yii::$app->user->id;
            $this->name = \Yii::$app->user->identity['name'];
            return true;
        }
        return false;
    }
}
