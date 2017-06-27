<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Signup;
use app\models\Login;

class SiteController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionSignup()
    {
        $model = new Signup();
        if (isset($_POST['Signup']))
        {
            $model->attributes = Yii::$app->request->post('Signup');
            if ($model->validate() && $model->signup())
            {
                return $this->goHome();
            }
        }
        return $this->render('signup', ['model' => $model]);
    }

    public function actionLogin()
    {
        $login_model = new Login();
        if (Yii::$app->request->post('Login'))
        {
            $login_model->attributes = Yii::$app->request->post('Login');
            if ($login_model->validate())
            {
//                var_dump('login was successful'); die();
            }
        }
        return $this->render('login', ['login_model' => $login_model]);
    }
}
