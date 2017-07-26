<?php

namespace common\models\database;

/**
 * This is the model class for table "user".
 *
 * @property integer $userId
 * @property string $email
 * @property string $passwordHash
 * @property string $name
 *
 * @property Passwordrecovery[] $passwordrecoveries
 */
class BaseUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'passwordHash', 'name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'userId' => 'User ID',
            'email' => 'Email',
            'passwordHash' => 'Password Hash',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPasswordrecoveries()
    {
        return $this->hasMany(Passwordrecovery::className(), ['userId' => 'userId']);
    }
}
