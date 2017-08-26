<?php

namespace frontend\controllers;

use common\models\database\Comment;
use common\models\database\Post;
use common\models\database\User;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class UserController extends Controller
{
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => (User::find()
                ->orderBy('userId')),
            'pagination' => [
                'pageSize' => 0,
            ],
        ]);
        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    public function actionView($userId)
    {
        $user = User::findOne(['userId' => $userId]);
        if (empty($user)) {
            Yii::$app->session->setFlash('error', 'incorrect user id');
            return $this->goHome();
        }
        $commentsProvider = new ActiveDataProvider([
            'query' => Comment::find()->orderBy('commentId'),
            'pagination' => [
                'pageSize' => 0,
            ],
        ]);
        $comment = new Comment();
        $dataProvider = new ActiveDataProvider([
            'query' => Post::find()->where(['userId' => $user->userId])->orderBy('userId'),
            'pagination' => [
                'pageSize' => 0,
            ],
        ]);
        $post = new Post();
        return $this->render('user', [
            'user' => $user,
            'post' => $post,
            'dataProvider' => $dataProvider,
            'commentsProvider' => $commentsProvider,
            'comment' => $comment
        ]);
    }


    public function actionArticles()
    {
        $comment = new Comment();
        $commentsProvider = new ActiveDataProvider([
            'query' => (Comment::find()
                ->orderBy('commentId')),
            'pagination' => [
                'pageSize' => 0,
            ],
        ]);
        $dataProvider = new ActiveDataProvider([
            'query' => (Post::find()
                ->orderBy('userId')),
            'pagination' => [
                'pageSize' => 3,
            ],
        ]);
        return $this->render('articles', [
            'dataProvider' => $dataProvider,
            'commentsProvider' => $commentsProvider,
            'comment' => $comment
        ]);
    }
}
