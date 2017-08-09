<?php

namespace frontend\models;

use common\models\database\Comment;
use yii\base\Model;

class CommentForm extends Model
{
    public $comment;
    public $postId;

    public function rules()
    {
        return [
            [['comment', 'postId'], 'required'],
            [['comment'], 'string', 'length' => [3, 250]]
        ];
    }

    public function saveComment()
    {
        $comment = new Comment();
        $comment->message = $this->comment;
        $comment->userId = \Yii::$app->user->id;
        $comment->postId = $this->postId;
        $comment->date = date('Y-m-d H:i:s', time());
        $comment->name = \Yii::$app->user->identity['name'];

        return $comment->save();
    }

}
