<?php

namespace frontend\controllers;

use common\models\database\Message;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class MessageController extends Controller
{
    public function actionIndex($receiverId)
    {
        if (\Yii::$app->user->isGuest) {
            return $this->goHome();
        }
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
