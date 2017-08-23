<?php use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\ListView;

$randomStr = \Yii::$app->security->generateRandomString();
?>

<div class="well">
    <div id="post_<?= $randomStr ?>">
        <?= $model->content ?> <br> <br>
        <img src="../../common/uploads/<?= $model->imageReference ?>" alt="err" class="img-responsive"> <br>
        <?= $model->date ?>
        <?php if (!\Yii::$app->user->isGuest): ?>
            <?php if (Yii::$app->user->id === $model->userId): ?>
                <?= Html::a('<span class="glyphicon glyphicon-trash"></span>', ['post/delete', 'id' => $model->postId],
                    [
                        'class' => 'btn btn-danger',
                        'style' => 'float: right',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ]) ?>
                <div class="btn btn-primary" id="edit_<?= $randomStr ?>" style="float: right; margin-right: 10px;"><span
                            class="glyphicon glyphicon-pencil"></span></div>
                <br> <br>
            <?php endif ?>
        <?php endif ?>


        <?php if (!\Yii::$app->user->isGuest): ?>
            <?php \yii\widgets\Pjax::begin(['timeout' => 5000]); ?>
            <?php $form =
                ActiveForm::begin(['options' => ['class' => 'comment-form'], 'action' => ['comment/create']]); ?>
            <?= $form->field($comment, 'message')->textarea(['rows' => 6]); ?>
            <?= $form->field($comment, 'postId')->hiddenInput(['value' => $model->postId])->label(false) ?>
            <div class="form-group">
                <?= Html::submitButton('Send', ['class' => 'btn btn-primary']); ?>
            </div>
            <?php $form = ActiveForm::end(); ?>
            <?php \yii\widgets\Pjax::end(); ?>
        <?php endif ?>

    </div>

    <div id="form_<?= $randomStr ?>" style="display: none;">
        <?php $form =
            ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data'],
                'action' => ['post/update', 'id' => $model->postId]]); ?>
        <?= $form->field($model, 'imageFile')->fileInput() ?>
        <?= $form->field($model, 'content')->textarea(['rows' => 6]); ?>
        <div class="form-group">
            <?= Html::submitButton('Update', ['class' => 'btn btn-primary']); ?>
            <span class="btn btn-danger" id="cancel_<?= $randomStr ?>">Cancel</span>
        </div>
        <?php ActiveForm::end(); ?>
    </div>

    <script type="text/javascript">
        var editPost = document.getElementById("edit_<?=$randomStr?>");
        var cancelEditing = document.getElementById("cancel_<?=$randomStr?>");

        editPost.onclick = function () {
            $('#post_<?=$randomStr?>').hide();
            $('#form_<?=$randomStr?>').show();
        };
        cancelEditing.onclick = function () {
            $('#post_<?=$randomStr?>').show();
            $('#form_<?=$randomStr?>').hide();
        };
    </script>

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
