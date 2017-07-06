<h1>login page</h1>

<?php
use \yii\widgets\ActiveForm;
use yii\helpers\Html;

?>

<?php
$form = ActiveForm::begin(['class' => 'form-horizontal']);
?>

<?= $form->field($login_model, 'email')->textInput(['autofocus' => true]) ?>

<?= $form->field($login_model, 'password')->passwordInput() ?>

<div>
    <button type="submit" class="btn btn-success">Login</button>
</div>

<?php
ActiveForm::end();
?>
<a href="send-email">Forgot the password?</a>

