<?php

namespace frontend\controllers;

use common\models\database\Post;
use common\models\database\User;
use frontend\models\UploadFileForm;
use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\data\Pagination;

class UserController extends Controller
{
    public function actionIndex()
    {
        $users = User::find()->all();
        return $this->render('index', ['users' => $users]);
    }

    public function actionDisplay($userId)
    {
        $user = User::findOne([
            'userId' => $userId
        ]);
        if (!empty($user)) {
            $uploadFileForm = new UploadFileForm();
            $post = new Post();
            if (Yii::$app->request->isPost) {
                $uploadFileForm->imageFile = UploadedFile::getInstance($uploadFileForm, 'imageFile');
                if (!$uploadFileForm->upload()) {
                    Yii::$app->getSession()->setFlash('error', 'Upload file error');
                }
                $post->userId = $user->userId;
                $post->date = date('Y-m-d H:i:s', time());
                $post->imageReference = $uploadFileForm->filename;
                $post->content = Yii::$app->request->post('Post')['content'];
                if ($post->validate()) {
                    $post->save();
                }
            }
            return $this->render('user', ['user' => $user, 'uploadFileForm' => $uploadFileForm, 'post' => $post]);
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
