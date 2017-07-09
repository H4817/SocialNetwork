<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */

    public function actionIndex()
    {
        if (Yii::$app->user->isGuest || Yii::$app->user->identity->name != "admin") {
            return $this->goHome();
        }
        return $this->render('index');
    }
}
