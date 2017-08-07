<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<?php \yii\widgets\Pjax::begin(['timeout' => 5000]); ?>
<?php $form = ActiveForm::begin(['options' => ['name' => 'publish', 'id' => 'message-form']]); ?>
<?= $form->field($model, 'message')->textarea(['rows' => 6, 'name' => 'message', 'id' => 'msg']); ?>
<div class="form-group">
    <?= Html::submitButton('<div class="glyphicon glyphicon-send"></div>', ['class' => 'btn btn-primary']); ?>
</div>
<?php $form = ActiveForm::end(); ?>

<div id="subscribe"></div>
<?php \yii\widgets\Pjax::end(); ?>

<script type="text/javascript">
    var socket = new WebSocket("ws://localhost:8080");

    $('#message-form').on('beforeSubmit', function () {
        sendMessage($('#msg').val());
    });

    socket.onopen = function (event) {
        subscribe(<?=$roomId?>);
        console.log("Connection established!");
    };

    socket.onmessage = function (event) {
        var incomingMessage = event.data;
        showMessage(incomingMessage);
    };

    function subscribe(channel) {
        socket.send(JSON.stringify({command: "subscribe", channel: channel}));
    }

    function sendMessage(msg) {
        socket.send(JSON.stringify({command: "message", message: msg}));
    }

    function showMessage(message) {
        var messageElem = document.createElement('div');
        messageElem.appendChild(document.createTextNode(message));
        document.getElementById('subscribe').appendChild(messageElem);
    }
</script>

