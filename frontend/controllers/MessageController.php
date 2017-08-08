<?php

namespace frontend\controllers;

use common\models\database\Message;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;
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
            $roomId = (\Yii::$app->user->id > $receiverId) ? $receiverId . \Yii::$app->user->id : \Yii::$app->user->id .
                $receiverId;

            $dataProvider = new ActiveDataProvider([
                'query' => (new ActiveQuery(Message::class))
                    ->from('message')
                    ->where(['and', ['senderId' => \Yii::$app->user->id], ['receiverId' => $receiverId]])
                    ->orWhere(['and', ['senderId' => $receiverId], ['receiverId' => \Yii::$app->user->id]])
                    ->orderBy('messageId'),
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

        return $this->goHome();
    }
}
