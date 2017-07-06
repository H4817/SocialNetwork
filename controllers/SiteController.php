<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Signup;
use app\models\Login;
use app\models\SendEmailForm;
use app\models\ResetPasswordForm;

class SiteController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionSignup()
    {
        if (!Yii::$app->user->isGuest)
        {
            return $this->goHome();
        }
        $model = new Signup();
        if (Yii::$app->request->post('Signup'))
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
        if (!Yii::$app->user->isGuest)
        {
            return $this->goHome();
        }
        $login_model = new Login();
        if (Yii::$app->request->post('Login'))
        {
            $login_model->attributes = Yii::$app->request->post('Login');
            if ($login_model->validate())
            {
                Yii::$app->user->login($login_model->getUser());
                return $this->goHome();
            }
        }
        return $this->render('login', ['login_model' => $login_model]);
    }

    public function actionLogout()
    {
        if (!Yii::$app->user->isGuest)
        {
            Yii::$app->user->logout();
            return $this->redirect(['login']);
        }
        return $this->goHome();
    }

    public function actionSendEmail()
    {
        $model = new SendEmailForm();

        if ($model->load(Yii::$app->request->post()))
        {
            if ($model->validate())
            {
                if ($model->sendEmail())
                {
                    Yii::$app->getSession()->setFlash('warning', 'Check your email');
                    return $this->goHome();
                } else
                {
                    Yii::$app->getSession()->setFlash('error', 'Cannot change the password');
                }
            }
        }

        return $this->render('sendEmail', [
            'model' => $model,
        ]);
    }

    public function actionResetPassword()
    {
        $model = new ResetPasswordForm();

        if ($model->load(Yii::$app->request->post()))
        {
            if ($model->validate())
            {
                // form inputs are valid, do something here
                return;
            }
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

}
