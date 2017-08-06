<?php use yii\helpers\Html;
use yii\widgets\ActiveForm;

$randomStr = \Yii::$app->security->generateRandomString();

if ($model->postId === $post->postId): ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <?php if ((\Yii::$app->user->id === $post->userId) || (\Yii::$app->user->id === $model->userId)): ?>
                <?= Html::a('delete', ['comment/delete', 'id' => $model->commentId], [
                    'style' => 'float: right; margin-left: 15px;',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            <?php endif ?>
            <strong><?= $model->name ?></strong> <span class="text-muted"
                                                       style="float: right"><?= $model->date ?></span>
        </div>
        <div class="panel-body" id="<?= $randomStr ?>"><?= $model->message ?></div>
    </div>
    <?php if (\Yii::$app->user->id === $model->userId): ?>
        <?php $form = ActiveForm::begin(['options' => ['style' => 'display: none;'], 'id' => $randomStr . 'form']); ?>
        <?= $form->field($model, 'message')->textarea(['rows' => 6])->label(false); ?>
        <?= $form->field($model, 'commentId')->hiddenInput(['value' => $model->commentId])->label(false) ?>
        <div class="form-group">
            <?= Html::submitButton('Confirm', ['class' => 'btn btn-primary']); ?>
        </div>
        <?php $form = ActiveForm::end(); ?>
        <script type="text/javascript">
            var commentArea = document.getElementById("<?=$randomStr?>");

            $('body').click(function(evt){
                if(( evt.target.id === "<?=$randomStr?>" ) || ( evt.target.id === "<?=$randomStr . 'form'?>" )) {
                    return;
                }
                if($(evt.target).closest('#<?=$randomStr?>').length || $(evt.target).closest('#<?=$randomStr?>form').length) {
                    return;
                }
                $('#<?=$randomStr?>').show();
                $('#<?=$randomStr . 'form'?>').hide();
            });
            commentArea.onclick = function () {
                $('#<?=$randomStr?>').hide();
                $('#<?=$randomStr . 'form'?>').show();
            };

        </script>
    <?php endif ?>
<?php endif ?>
