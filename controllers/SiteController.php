<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\SignupForm;
use app\models\LoginForm;
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
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new SignupForm();
        if (Yii::$app->request->post('SignupForm')) {
            $model->attributes = Yii::$app->request->post('SignupForm');
            if ($model->validate() && $model->signup()) {
                return $this->goHome();
            }
        }
        return $this->render('signup', ['model' => $model]);
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $loginModel = new LoginForm();
        if (Yii::$app->request->post('LoginForm')) {
            $loginModel->attributes = Yii::$app->request->post('LoginForm');
            if ($loginModel->validate()) {
                Yii::$app->user->login($loginModel->getUser());
                return $this->goHome();
            }
        }
        return $this->render('login', ['loginModel' => $loginModel]);
    }

    public function actionLogout()
    {
        if (!Yii::$app->user->isGuest) {
            Yii::$app->user->logout();
            return $this->redirect(['login']);
        }
        return $this->goHome();
    }

    public function actionSendEmail()
    {
        $model = new SendEmailForm();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                if ($model->sendEmail()) {
                    Yii::$app->getSession()->setFlash('warning', 'Check your email');
                    return $this->goHome();
                } else {
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

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                // form inputs are valid, do something here
                return;
            }
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

}
