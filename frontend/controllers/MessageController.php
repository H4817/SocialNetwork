<?php

namespace frontend\controllers;

use common\models\database\BaseMessage;
use common\models\database\Message;
use common\models\database\User;
use yii\web\Controller;

class MessageController extends Controller
{
    public function actionIndex($receiverId)
    {
        if (!\Yii::$app->user->isGuest) {
            $model = new Message();
            if (!empty(\Yii::$app->request->post()['message'])) {
                $model->load(array(\Yii::$app->user->id, $receiverId, \Yii::$app->request->post()['message']));
            }
            $roomId = (\Yii::$app->user->id > $receiverId) ? $receiverId . \Yii::$app->user->id : \Yii::$app->user->id . $receiverId;
            return $this->render('index', ['roomId' => $roomId, 'model' => $model]);
        }

            return $this->goHome();
    }
}
