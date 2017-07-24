<?php

namespace frontend\controllers;

use common\models\database\Post;
use common\models\database\User;
use frontend\models\UploadFileForm;
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
            'query' => (new ActiveQuery(User::class))
                ->from('user')
                ->orderBy('userId'),
            'pagination' => [
                'pageSize' => 3,
            ],
        ]);
        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    public function actionView($userId)
    {
        $user = User::findOne(['userId' => $userId]);
        if (!empty($user)) {
            $dataProvider = new ActiveDataProvider([
                'query' => (new ActiveQuery(Post::class))
                    ->from('post')
                    ->where(['userId' => $user->userId])
                    ->orderBy('userId'),
                'pagination' => [
                    'pageSize' => 3,
                ],
            ]);
            $uploadFileForm = new UploadFileForm();
            $post = new Post();
            if (Yii::$app->request->isPost) {
                $uploadFileForm->imageFile = UploadedFile::getInstance($uploadFileForm, 'imageFile');
                if (!$uploadFileForm->upload()) {
                    Yii::$app->getSession()->setFlash('error', 'Upload file error');
                }
                $post->_save($user->userId, $uploadFileForm->filename, Yii::$app->request->post('Post')['content']);
            }
            return $this->render('user',
                ['user' => $user, 'uploadFileForm' => $uploadFileForm, 'post' => $post, 'dataProvider' => $dataProvider]);
        }
        Yii::$app->session->setFlash('error', 'incorrect user id');
        return $this->goHome();
    }

    public function actionArticles()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => (new ActiveQuery(Post::class))
                ->from('post')
                ->orderBy('userId'),
            'pagination' => [
                'pageSize' => 3,
            ],
        ]);
        return $this->render('articles', ['dataProvider' => $dataProvider]);
    }
}
