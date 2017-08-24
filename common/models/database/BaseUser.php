<?php

namespace common\models\database;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $userId
 * @property string $email
 * @property string $passwordHash
 * @property string $name
 *
 * @property Comment[] $comments
 * @property Message[] $messages
 * @property Message[] $messages0
 * @property PasswordRecovery[] $passwordRecoveries
 * @property Post[] $posts
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
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['userId' => 'userId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMessages()
    {
        return $this->hasMany(Message::className(), ['receiverId' => 'userId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMessages0()
    {
        return $this->hasMany(Message::className(), ['senderId' => 'userId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPasswordRecoveries()
    {
        return $this->hasMany(PasswordRecovery::className(), ['userId' => 'userId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['userId' => 'userId']);
    }
}
