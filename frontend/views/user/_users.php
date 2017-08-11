<div class="well">
    <a href="<?= Yii::$app->urlManager->createAbsoluteUrl(['user/view',
        'userId' => $model->userId]) ?>"><?= $model->name ?></a>
    <?php if ((!\Yii::$app->user->isGuest) && (\Yii::$app->user->id !== $model->userId)): ?>
        <a class="glyphicon glyphicon-comment" style="float: right; text-decoration: none;"
           href="<?= Yii::$app->urlManager->createAbsoluteUrl(['message/index', 'receiverId' => $model->userId]) ?>">
        </a>
    <?php endif ?>
</div>

