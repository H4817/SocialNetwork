<?php use yii\helpers\Html;
use yii\widgets\ActiveForm;


if ($model->postId === $post->postId): ?>
    <div class="comment-container">
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
            <div class="panel-body"><?= $model->message ?></div>
        </div>
        <?php if (\Yii::$app->user->id === $model->userId): ?>
            <?php $form = ActiveForm::begin(['options' => ['class' => 'comment-form', 'style' => 'display: none;'],
                'action' => ['comment/update', 'id' => $model->commentId]]); ?>
            <?= $form->field($model, 'message')->textarea(['rows' => 6])->label(false); ?>
            <?= $form->field($model, 'commentId')->hiddenInput(['value' => $model->commentId])->label(false) ?>
            <div class="form-group">
                <?= Html::submitButton('Confirm', ['class' => 'btn btn-primary']); ?>
            </div>
        <?php $form = ActiveForm::end(); ?>
        <?php endif ?>
    </div>
<?php endif ?>
