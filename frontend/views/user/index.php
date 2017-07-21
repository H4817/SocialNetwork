<?php
use common\models\database\User;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;

$dataProvider = new ActiveDataProvider([
    'query' => User::find()->where(['>', 'userId', '0']),
    'pagination' => [
        'pageSize' => 10,
    ],
]);

echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_users',
]);



