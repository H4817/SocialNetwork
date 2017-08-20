<?php

namespace common\models\database;

/**
 * This is the model class for table "comment".
 *
 * @property integer $commentId
 * @property integer $postId
 * @property integer $userId
 * @property string $message
 * @property string $date
 * @property string $name
 *
 * @property Post $post
 * @property User $user
 */
class BaseComment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['postId', 'userId'], 'integer'],
            [['date'], 'safe'],
            [['message', 'name'], 'string', 'max' => 255],
            [['postId'], 'exist', 'skipOnError' => true, 'targetClass' => Post::className(),
                'targetAttribute' => ['postId' => 'postId']],
            [['userId'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(),
                'targetAttribute' => ['userId' => 'userId']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'commentId' => 'Comment ID',
            'postId' => 'Post ID',
            'userId' => 'User ID',
            'message' => 'Message',
            'date' => 'Date',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(Post::className(), ['postId' => 'postId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['userId' => 'userId']);
    }
}
