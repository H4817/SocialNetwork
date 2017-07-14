<?php

namespace frontend\controllers;

use common\models\database\User;
use yii\web\Controller;

class UserController extends Controller
{
    public function actionIndex()
    {
        $users = User::find()->all();
        return $this->render('index', ['users' => $users]);
    }
}
