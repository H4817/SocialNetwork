<?php

namespace frontend\controllers;

use common\models\database\BaseMessage;
use yii\web\Controller;

class MessageController extends Controller
{
    public function actionIndex($receiverId)
    {
        if (!\Yii::$app->user->isGuest) {
            $model = new BaseMessage();
            return $this->render('index', ['receiverId' => $receiverId, 'model' => $model]);
        }
        return $this->goHome();
    }
}
