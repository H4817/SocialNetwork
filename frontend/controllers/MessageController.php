<?php

namespace frontend\controllers;

use common\components\Behaviors;
use common\models\database\Message;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class MessageController extends Controller
{
    public function behaviors()
    {
        return [
            [
                'class' => Behaviors::className()
            ]
        ];
    }

    public function actionIndex($receiverId)
    {
        $this->redirectGuests($this);
        $model = new Message();
        $userId = \Yii::$app->user->id;
        $roomId = ($userId > $receiverId) ? $receiverId . $userId : $userId . $receiverId;
        $dataProvider = new ActiveDataProvider([
            'query' => Message::findChatMessages($userId, $receiverId),
            'pagination' => [
                'pageSize' => 0,
            ],
        ]);
        $this->layout = 'messaging';
        return $this->render('index', [
            'roomId' => $roomId,
            'model' => $model,
            'receiverId' => $receiverId,
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionSendMessage($receiverId)
    {
        $model = new Message();
        $userId = \Yii::$app->user->id;
        if (!empty(\Yii::$app->request->post()['message'])) {
            $model->load(array($userId, $receiverId, \Yii::$app->request->post()['message']));
        }
        return $this->redirect(\Yii::$app->request->referrer);
    }
}
