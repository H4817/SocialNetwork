<?php

namespace frontend\controllers;

use common\models\database\Comment;
use common\models\database\Post;
use common\models\database\User;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;
use yii\web\Controller;
use yii\web\UploadedFile;

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
        if (!empty($user)) {
            $commentsProvider = new ActiveDataProvider([
                'query' => (Comment::find()
                    ->orderBy('commentId')),
                'pagination' => [
                    'pageSize' => 0,
                ],
            ]);
            $comment = new Comment();
            $dataProvider = new ActiveDataProvider([
                'query' => (Post::find()
                    ->where(['userId' => $user->userId])
                    ->orderBy('userId')),
                'pagination' => [
                    'pageSize' => 0,
                ],
            ]);
            $post = new Post();
            if (Yii::$app->request->isPost) {
                if (\Yii::$app->request->post('Post')) {
                    $post->imageFile = UploadedFile::getInstance($post, 'imageFile');
                    if (!$post->savePostImage()) {
                        Yii::$app->getSession()->setFlash('error', 'Upload file error');
                    }
                    $post->saveToDatabase($user->userId, Yii::$app->request->post('Post')['content']);
                } else if (\Yii::$app->request->post('Comment')) {
                    $specificComment =
                        Comment::findOne(['commentId' => \Yii::$app->request->post('Comment')['commentId']]);
                    $specificComment->message = \Yii::$app->request->post('Comment')['message'];
                    $specificComment->update();
                }
            }
            return $this->render('user', [
                'user' => $user,
                'post' => $post,
                'dataProvider' => $dataProvider,
                'commentsProvider' => $commentsProvider,
                'comment' => $comment
            ]);
        }
        Yii::$app->session->setFlash('error', 'incorrect user id');
        return $this->goHome();
    }

    public function actionArticles()
    {
        $comment = new comment();
        if (\Yii::$app->request->post('Comment')) {
            $specificComment =
                Comment::findOne(['commentId' => \Yii::$app->request->post('Comment')['commentId']]);
            $specificComment->message = \Yii::$app->request->post('Comment')['message'];
            $specificComment->update();
        }
        $commentsProvider = new ActiveDataProvider([
            'query' => (new ActiveQuery(Comment::class))
                ->from('comment')
                ->orderBy('commentId'),
            'pagination' => [
                'pageSize' => 0,
            ],
        ]);
        $dataProvider = new ActiveDataProvider([
            'query' => (new ActiveQuery(Post::class))
                ->from('post')
                ->orderBy('userId'),
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
