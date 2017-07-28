<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\widgets\ListView;

$this->title = $user->name;

?>


<?php if (\Yii::$app->user->id === $user->userId) : ?>
    <h1>Create new post</h1>

    <div class="row">
        <div class="col-lg-5">
            <?php $form =
                ActiveForm::begin(['id' => 'post-form', 'options' => ['enctype' => 'multipart/form-data']]); ?>

            <?= $form->field($uploadFileForm, 'imageFile')->fileInput() ?>
            <?= $form->field($post, 'content')->textarea(['rows' => 6]); ?>

            <div class="form-group">
                <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'post-button']); ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
<?php endif; ?>


<?php
echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_articles',
    'viewParams' => ['commentsProvider' => $commentsProvider, 'commentForm' => $commentForm]
]);
?>

