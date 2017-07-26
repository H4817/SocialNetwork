<?php

namespace common\models\database;

use Yii;

/**
 * This is the model class for table "passwordrecovery".
 *
 * @property integer $passwordRecoveryId
 * @property integer $userId
 * @property string $token
 * @property string $date
 *
 * @property User $user
 */
class PasswordRecovery extends BasePasswordRecovery
{
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int)substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    public function generatePasswordResetToken()
    {
        return Yii::$app->security->generateRandomString() . '_' . time();
    }

}
