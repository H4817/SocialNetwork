<?php use yii\helpers\Url; ?>
<div class="well">
    <a href="<?= Url::to(['user/view', 'userId' => $model->userId]) ?>"><?= $model->name ?></a>
    <?php if ((!\Yii::$app->user->isGuest) && (\Yii::$app->user->id !== $model->userId)): ?>
        <a class="glyphicon glyphicon-comment" style="float: right; text-decoration: none;"
           href="<?= Url::to(['message/index', 'receiverId' => $model->userId]) ?>">
        </a>
    <?php endif ?>
</div>

