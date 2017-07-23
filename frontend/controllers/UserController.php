<?php

namespace frontend\controllers;

use common\models\database\Post;
use common\models\database\User;
use frontend\models\UploadFileForm;
use Yii;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
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
                'pageSize' => 1,
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
                    'pageSize' => 1,
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
