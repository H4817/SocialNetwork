<?php use yii\helpers\Html; ?>

<div class="well"><?= $model->content ?> <br> <br>
    <img src="../../common/uploads/<?= $model->imageReference ?>" alt="err" class="img-responsive"> <br>
    <?= $model->date ?>
    <?php if (Yii::$app->user->id === $model->userId): ?>
        <?= Html::a('Delete', ['post/delete', 'id' => $model->postId], [
            'class' => 'btn btn-danger',
            'style' => 'float: right',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    <?php endif ?>
</div>

