<?php
use common\models\database\Post;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

?>
<?php
$this->title = $user->name;
$post = Post::findOne([
    'userId' => $user->userId
]);
if (empty($post)) {
    $post = new Post();
}
?>

<h1>Create new post</h1>

<div class="row">
    <div class="col-lg-5">
        <?php $form = ActiveForm::begin(['id' => 'post-form', 'options' => ['enctype' => 'multipart/form-data']]); ?>

        <?= $form->field($post, 'imageReference')->fileInput() ?>

        <?= $form->field($post, 'content')->textarea(['rows' => 6]) ?>

        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'post-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
