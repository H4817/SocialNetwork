<?php use yii\helpers\Html; ?>

<div class="well"><?= $model->content ?> <br> <br>
    <img src="../../common/uploads/<?= $model->imageReference ?>" alt="err" class="img-responsive"> <br>
    <?= $model->date ?>

    <?php if (Yii::$app->getUser()): ?>
        <?php if (Yii::$app->user->id === $model->userId): ?>
            <?= Html::a('<span class="glyphicon glyphicon-trash"></span>', ['post/delete', 'id' => $model->postId], [
                'class' => 'btn btn-danger',
                'style' => 'float: right',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?> <br> <br>
        <?php endif ?>
    <?php endif ?>

    <?php if (!empty($comments)): ?>
        <?php foreach ($comments->each() as $comment): ?>
            <?php if ($comment->postId === $model->postId): ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong><?= $comment->name ?></strong> <span class="text-muted"><?= $comment->date ?></span>
                    </div>
                    <div class="panel-body"><?= $comment->message ?></div>
                </div>
            <?php endif ?>
        <?php endforeach ?>
    <?php endif ?>
</div> <br> <br>
