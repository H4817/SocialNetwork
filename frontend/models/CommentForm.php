<?php

namespace frontend\models;

use common\models\database\BaseComment;
use yii\base\Model;

class CommentForm extends Model
{
    public $comment;

    public function rules()
    {
        return [
            [['comment'], 'required'],
            [['comment'], 'string', 'length' => [3, 250]]
        ];
    }

    public function saveComment($articleId)
    {
        $comment = new BaseComment();
        $comment->message = $this->comment;
        $comment->userId = \Yii::$app->user->id;
        $comment->postId = $articleId;
        $comment->date = date('Y-m-d H:i:s', time());

        return $comment->save();
    }

}
