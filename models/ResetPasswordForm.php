<?php

namespace app\models;

use Yii;
use yii\base\Model;

class ResetPasswordForm extends Model
{
    public $password;
    private $_user;

    public function rules()
    {
        return [
            ['password', 'required']
        ];
    }

    public function attributeLabels()
    {
        return ['password' => 'Пароль'];
    }

    public function resetPassword()
    {
        $user = $this->_user;
        $user->setPassword($this->password);
        return $user->save();
    }
}
