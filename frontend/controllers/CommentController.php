<?php

namespace frontend\controllers;

use common\models\database\BaseComment;
use yii\db\ActiveQuery;
use yii\web\Controller;

class CommentController extends Controller
{
    public function actionIndex()
    {
        $comments = ((new ActiveQuery(BaseComment::class))->from('comment')->orderBy('commentId'));
        return $this->render('index', ['comments' => $comments]);
    }

    public function actionDelete($id)
    {
        $comment = BaseComment::findOne(['commentId' => $id]);
        $comment->delete();
        return $this->redirect(\Yii::$app->request->referrer);
    }

    public function actionUpdate($id, $message)
    {
        $comment = BaseComment::findOne(['commentId' => $id]);
        $comment->message = $message;
        $comment->update();
        return $this->redirect(\Yii::$app->request->referrer);
    }
}
