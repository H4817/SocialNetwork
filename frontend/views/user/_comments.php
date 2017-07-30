<?php use yii\helpers\Html;

if ($model->postId === $post->postId): ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <?php if (( \Yii::$app->user->id === $post->userId ) || (\Yii::$app->user->id === $model->userId)):?>
            <?= Html::a('delete', ['comment/delete', 'id' => $model->commentId], [
                'style' => 'float: right; margin-left: 15px;',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
            <?php endif?>
            <strong><?=$model->name?></strong> <span class="text-muted" style="float: right"><?=$model->date?></span>
        </div>
        <div class="panel-body"><?=$model->message?></div>
    </div>

<?php endif ?>
