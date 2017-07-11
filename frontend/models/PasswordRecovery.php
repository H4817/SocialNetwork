<?php

namespace frontend\models;

use common\models\User;
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
class PasswordRecovery extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'passwordrecovery';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userId'], 'integer'],
            [['date'], 'safe'],
            [['token'], 'string', 'max' => 255],
            [['userId'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['userId' => 'userId']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'passwordRecoveryId' => 'Password Recovery ID',
            'userId' => 'User ID',
            'token' => 'Token',
            'date' => 'Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['userId' => 'userId']);
    }
}
