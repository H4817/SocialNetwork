<?php

use yii\helpers\Html;

echo 'Привет ' . Html::encode($user->getAttribute('name')) . '. ';
echo Html::a('Для смены пароля перейдите по этой ссылке.',
    Yii::$app->urlManager->createAbsoluteUrl(
        [
            '/main/reset-password',
            'key' => $model->token
        ]
    ));
