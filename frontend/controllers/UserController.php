<?php

namespace frontend\controllers;

use common\models\database\User;
use UploadFileForm;
use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;

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
            if (Yii::$app->request->isPost) {
                $uploadFileForm = new UploadFileForm();
                $uploadFileForm->imageFile = UploadedFile::getInstance($uploadFileForm, 'imageFile');
                if (!$uploadFileForm->upload()) {
                    Yii::$app->getSession()->setFlash('error', 'Upload file error');
                }
            }
            return $this->render('user', ['user' => $user]);
        }
        Yii::$app->session->setFlash('error', 'incorrect user id');
        return $this->goHome();
    }
}
