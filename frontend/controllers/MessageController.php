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
        if (!empty(\Yii::$app->request->post()['message'])) {
            $model->load(array(\Yii::$app->user->id, $receiverId, \Yii::$app->request->post()['message']));
        }
        $roomId = (\Yii::$app->user->id > $receiverId) ? $receiverId . \Yii::$app->user->id : \Yii::$app->user->id .
            $receiverId;

        $dataProvider = new ActiveDataProvider([
            'query' => Message::findChatMessages(\Yii::$app->user->id, $receiverId),
            'pagination' => [
                'pageSize' => 0,
            ],
        ]);

        $this->layout = 'messaging';
        return $this->render('index', [
            'roomId' => $roomId,
            'model' => $model,
            'dataProvider' => $dataProvider
        ]);
    }
}
