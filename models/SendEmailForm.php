<?php

namespace app\models;

use app\models\database\PasswordRecovery;
use app\models\database\User;
use Yii;
use yii\base\Model;

class SendEmailForm extends Model
{
    public $email;

    public function rules()
    {
        return [
            ['email', 'filter', 'filter' => 'trim'],
            [['email'], 'required'],
            ['email', 'email'],
            ['email', 'exist',
                'targetClass' => User::className(),
//                'filter' => [
//                    'status' => User::STATUS_ACTIVE
//                ]
                'message' => 'This email is not registered'
            ]
        ];
    }

    public function attributeLabels()
    {
        return [
            'email' => 'Емайл'
        ];
    }

    public function sendEmail()
    {
        $user = User::findOne(
            [
//                'status' => User::STATUS_ACTIVE,
                'email' => $this->email
            ]
        );
        if (!empty($user)) {
            $model = new PasswordRecovery($user->id);
            if ($model->save()) {
                return Yii::$app->mailer->compose('layouts/resetPasswordEmail', ['user' => $user, 'model' => $model])
                    ->setFrom('from@domain.com')
                    ->setTo($this->email)
                    ->setSubject('Сброс пароля для ' . Yii::$app->name)
                    ->send();
            }
        }
        return false;
    }
}
