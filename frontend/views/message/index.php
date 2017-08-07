<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->registerCssFile('css/messages.css');
?>

<?php \yii\widgets\Pjax::begin(['timeout' => 5000]); ?>
<?php $form = ActiveForm::begin(['options' => ['name' => 'publish', 'id' => 'message-form']]); ?>
<?= $form->field($model, 'message')->textarea(['rows' => 6, 'name' => 'message', 'id' => 'msg']); ?>
<div class="form-group">
    <?= Html::submitButton('<div class="glyphicon glyphicon-send"></div>', ['class' => 'btn btn-primary']); ?>
</div>
<?php $form = ActiveForm::end(); ?>

<ul id="messages" class="messages"></ul>
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
        var messageElem = document.createElement('li');
        messageElem.className += 'message left appeared';
        var avatar = document.createElement('div');
        avatar.className += 'profile';
        avatar.setAttribute('data-name', 'Nikolaj');

        var textWrapper = document.createElement('div');
        textWrapper.className += 'text_wrapper';
        var text = document.createElement('div');
        text.className += 'text';
        text.appendChild(document.createTextNode(message));
        textWrapper.appendChild(text);
        messageElem.appendChild(avatar);
        messageElem.appendChild(textWrapper);
        $('.profile').initial();
        document.getElementById('messages').appendChild(messageElem);
    }
</script>

