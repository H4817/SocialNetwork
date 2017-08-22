<?php use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\ListView;

?>
<div class="well"><?= $model->content ?> <br> <br>
    <img src="../../common/uploads/<?= $model->imageReference ?>" alt="err" class="img-responsive"> <br>
    <?= $model->date ?>
    <?php if (!\Yii::$app->user->isGuest): ?>
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
    <?php if (!\Yii::$app->user->isGuest): ?>
        <?php \yii\widgets\Pjax::begin(['timeout' => 5000]); ?>
        <?php $form = ActiveForm::begin(['options' => ['class' => 'comment-form'], 'action' => ['comment/create']]); ?>
        <?= $form->field($comment, 'message')->textarea(['rows' => 6]); ?>
        <?= $form->field($comment, 'postId')->hiddenInput(['value' => $model->postId])->label(false) ?>
        <div class="form-group">
            <?= Html::submitButton('Send', ['class' => 'btn btn-primary']); ?>
        </div>
        <?php $form = ActiveForm::end(); ?>
        <?php \yii\widgets\Pjax::end(); ?>
    <?php endif ?>

    <?php \yii\widgets\Pjax::begin(['timeout' => 5000]); ?>
    <?php
    echo ListView::widget([
        'dataProvider' => $commentsProvider,
        'itemView' => '_comments',
        'viewParams' => ['post' => $model],
        'summary' => ''
    ]);
    ?>
    <?php \yii\widgets\Pjax::end(); ?>
</div> <br> <br>
