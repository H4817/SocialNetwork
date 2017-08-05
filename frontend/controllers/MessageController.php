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
            $roomId = (\Yii::$app->user->id > $receiverId) ? $receiverId . \Yii::$app->user->id : \Yii::$app->user->id . $receiverId;
            return $this->render('index', ['receiverId' => $receiverId, 'roomId' => $roomId, 'model' => $model]);
        }
        return $this->goHome();
    }
}
