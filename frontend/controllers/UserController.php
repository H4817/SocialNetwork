<?php

namespace frontend\controllers;

use common\models\database\Post;
use common\models\database\User;
use frontend\models\UploadFileForm;
use Yii;
use yii\db\ActiveQuery;
use yii\db\Query;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\data\Pagination;

class UserController extends Controller
{
    public function actionIndex()
    {
        $users = (new ActiveQuery(User::class))
            ->from('user')
            ->orderBy('userId');
        return $this->render('index', ['users' => $users]);
    }

    public function actionView($userId)
    {
        $user = User::findOne(['userId' => $userId]);
        if (!empty($user)) {
            $models = Post::find()->where(['userId' => $user->userId]);
            $countQuery = clone $models;
            $pagination = new Pagination([
                'defaultPageSize' => 1,
                'totalCount' => $countQuery->count()
            ]);
            $models = $models->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all();
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
                ['user' => $user, 'uploadFileForm' => $uploadFileForm, 'post' => $post, 'models' => $models,
                    'pagination' => $pagination]);
        }
        Yii::$app->session->setFlash('error', 'incorrect user id');
        return $this->goHome();
    }

    public function actionArticles()
    {
        $allUsers = User::find()->where(['>', 'userId', '0']);
        $countQuery = clone $allUsers;
        $pagination = new Pagination([
            'defaultPageSize' => 1,
            'totalCount' => $countQuery->count()
        ]);
        $models = $allUsers->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        return $this->render('articles', ['models' => $models, 'pagination' => $pagination]);
    }
}
