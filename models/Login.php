<?php

namespace app\models;

use Yii;
use yii\base\Model;

class Login extends Model
{
    public $email;
    public $password;

    public function rules()
    {
        return [
            [['email', 'password'], 'required'],
            ['email', 'email'],
            ['password', 'validatePassword']
        ];
    }

    public function validatePassword($attribute, $params)
    {
        $user = User::findOne(['email' => $this->email]);
        if (!$user || !(Yii::$app->getSecurity()->validatePassword($this->password, $user->password)))
        {
            $this->addError($attribute, 'incorrect user name or password');
        }
    }
}
