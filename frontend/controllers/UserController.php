<?php

namespace frontend\controllers;

use common\models\database\User;
use Yii;
use yii\web\Controller;

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
            return $this->render('user', ['user' => $user]);
        }
        Yii::$app->session->setFlash('error', 'incorrect user id');
        return $this->goHome();
    }
}
