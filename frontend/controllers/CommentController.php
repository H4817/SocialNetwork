<?php

namespace frontend\controllers;

use common\models\database\Comment;
use yii\web\Controller;

class CommentController extends Controller
{
    public function actionIndex()
    {
        $comments = Comment::find()->orderBy('commentId');
        return $this->render('index', ['comments' => $comments]);
    }

    public function actionDelete($id)
    {
        $comment = Comment::findOne(['commentId' => $id]);
        $comment->delete();
        return $this->redirect(\Yii::$app->request->referrer);
    }

    public function actionUpdate($id, $message)
    {
        $comment = Comment::findOne(['commentId' => $id]);
        $comment->message = $message;
        $comment->update();
        return $this->redirect(\Yii::$app->request->referrer);
    }
}
