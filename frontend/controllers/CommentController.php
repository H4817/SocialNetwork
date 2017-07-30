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
        if (!$comment->delete()) {
            \Yii::$app->getSession()->setFlash('error', 'cannot delete this comment');
        }
        return $this->redirect(\Yii::$app->request->referrer);
    }
}
