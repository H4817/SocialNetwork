<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{
    /*    public function rules()
        {
            return [
                [['name', 'email', 'password'], 'required'],
                ['name', 'string', 'min' => 2, 'max' => 20],
                ['email', 'email'],
                ['password', 'string', 'min' => 2, 'max' => 20]
            ];
        }*/

    public function generatePasswordHash($password)
    {
        return Yii::$app->getSecurity()->generatePasswordHash($password);
    }

    public function setPassword($password)
    {
        $this->password = $this->generatePasswordHash($password);
    }

    public function validatePassword($password)
    {
        return (Yii::$app->getSecurity()->validatePassword($password, $this->password));
    }

    public static function tableName() { return 'user'; }

    public static function findIdentity($id) { return self::findOne($id); }

    public static function findIdentityByAccessToken($token, $type = null) { }

    public function getId() { return $this->id; }

    public function getAuthKey() { }

    public function validateAuthKey($authKey) { }


}
