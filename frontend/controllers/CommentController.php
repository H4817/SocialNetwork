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

    public function actionCreate()
    {
        $model = new Comment();
        if ($model->load(\Yii::$app->request->post())) {
            if (!($model->save())) {
                \Yii::$app->session->setFlash('error', 'cannot add comment');
            }
        }
        return $this->redirect(\Yii::$app->request->referrer);
    }

    public function actionUpdate($id)
    {
        $comment = Comment::findOne(['commentId' => $id]);
        $comment->load(\Yii::$app->request->post());
        $comment->update();
        return $this->redirect(\Yii::$app->request->referrer);
    }

    public function actionDelete($id)
    {
        $comment = Comment::findOne(['commentId' => $id]);
        $comment->delete();
        return $this->redirect(\Yii::$app->request->referrer);
    }

}
