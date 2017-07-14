<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\database\User;
use common\models\database\PasswordRecovery;

/**
 * Password reset request form
 */
class PasswordResetRequestForm extends Model
{
    public $email;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'exist',
                'targetClass' => '\common\models\database\User',
                'message' => 'There is no user with this email address.'
            ],
        ];
    }

    /**
     * Sends an email with a link, for resetting the password.
     *
     * @return bool whether the email was send
     */
    public function sendEmail()
    {
        /* @var $user User */
        $user = User::findOne([
            'email' => $this->email,
        ]);

        if (!empty($user))
        {
            $model = PasswordRecovery::findOne([
                'userId' => $user->userId,
            ]);
            if (!$model)
            {
                $model = new PasswordRecovery();
                $model->date = date('Y-m-d H:i:s', time());
                $model->userId = $user->userId;
            }
            $model->token = $model->generatePasswordResetToken();
            if (!$model->save())
            {
                return false;
            }
            /*            if (!User::isPasswordResetTokenValid($model->token))
                        {
                            $user->generatePasswordResetToken();
                            if (!$user->save())
                            {
                                return false;
                            }
                        }*/

            return Yii::$app
                ->mailer
                ->compose(
                    ['html' => 'passwordResetToken-html', 'text' => 'passwordResetToken-text'],
                    ['user' => $user, 'model' => $model]
                )
                ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
                ->setTo($this->email)
                ->setSubject('Password reset for ' . Yii::$app->name)
                ->send();
        }
        return false;
    }
}
