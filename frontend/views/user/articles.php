<?php
use yii\widgets\ListView;

echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_articles',
    'viewParams' => ['commentsProvider' => $commentsProvider, 'commentForm' => $commentForm]
]);


