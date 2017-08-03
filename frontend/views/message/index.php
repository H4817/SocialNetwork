<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<?php $form = ActiveForm::begin(['options' => ['name' => 'publish']]); ?>
<?= $form->field($model, 'message')->textarea(['rows' => 6, 'name' => 'message']); ?>
<div class="form-group">
    <?= Html::submitButton('<div class="glyphicon glyphicon-send"></div>', ['class' => 'btn btn-primary']); ?>
</div>
<?php $form = ActiveForm::end(); ?>

<div id="subscribe"></div>

<script type="text/javascript">
    var socket = new WebSocket("ws://localhost:8080");
    document.forms.publish.onsubmit = function () {
        var outgoingMessage = this.message.value;
        socket.send(outgoingMessage);
        return false;
    };

    socket.onmessage = function (event) {
        var incomingMessage = event.data;
        showMessage(incomingMessage);
    };

    function showMessage(message) {
        var messageElem = document.createElement('div');
        messageElem.appendChild(document.createTextNode(message));
        document.getElementById('subscribe').appendChild(messageElem);
    }
</script>