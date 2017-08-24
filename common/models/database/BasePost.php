<?php

namespace common\models\database;

use Yii;

/**
 * This is the model class for table "post".
 *
 * @property integer $postId
 * @property integer $userId
 * @property string $content
 * @property string $imageReference
 * @property string $date
 *
 * @property Comment[] $comments
 * @property User $user
 */
class BasePost extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userId'], 'integer'],
            [['date'], 'safe'],
            [['content', 'imageReference'], 'string', 'max' => 255],
            [['userId'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['userId' => 'userId']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'postId' => 'Post ID',
            'userId' => 'User ID',
            'content' => 'Content',
            'imageReference' => 'Image Reference',
            'date' => 'Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['postId' => 'postId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['userId' => 'userId']);
    }
}
