<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{
    public function setPassword($password)
    {
        $this->password = Yii::$app->getSecurity()->generatePasswordHash($password);
    }

    public function validatePassword($password)
    {
        return (Yii::$app->getSecurity()->validatePassword($password, $this->password));
    }

    public static function findIdentity($id) { return self::findOne($id); }

    public static function findIdentityByAccessToken($token, $type = null) { }

    public function getId() { return $this->id; }

    public function getAuthKey() { }

    public function validateAuthKey($authKey) { }


}
