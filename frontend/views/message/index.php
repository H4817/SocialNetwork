<?php
use common\models\database\User;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\ListView;

$this->registerCssFile('css/messages.css');
if (class_exists('yii\debug\Module')) {
    $this->off(\yii\web\View::EVENT_END_BODY, [\yii\debug\Module::getInstance(), 'renderToolbar']);
}
$participants = array();
$participants['sender'] = \Yii::$app->user->identity['name'];
$participants['receiver'] =  User::findOne(['userId' => $receiverId])['name'];
?>

<?php \yii\widgets\Pjax::begin(['timeout' => 5000]); ?>
<?php $form = ActiveForm::begin(['options' => ['name' => 'publish', 'id' => 'message-form'],
    'action' => ['message/send-message', 'receiverId' => $receiverId]]) ?>
<?= $form->field($model, 'message')->textarea(['rows' => 6, 'name' => 'message', 'id' => 'msg']); ?>
<div class="form-group">
    <?= Html::submitButton('<div class="glyphicon glyphicon-send"></div>', ['class' => 'btn btn-primary']); ?>
</div>
<?php $form = ActiveForm::end(); ?>
<ul id="messages" class="messages">
    <?php echo ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_messages',
        'summary' => '',
        'viewParams' => ['participants' => $participants]
    ]);
    ?>
</ul>
<?php \yii\widgets\Pjax::end(); ?>

<script type="text/javascript">
    $('.avatar').initial();
    var socket = new WebSocket("ws://localhost:8080");

    $('#message-form').on('beforeSubmit', function () {
        var msg = $('#msg').val();
        sendMessage(msg);
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
        avatar.className += 'avatar';

        var textWrapper = document.createElement('div');
        textWrapper.className += 'text_wrapper';
        var text = document.createElement('div');
        text.className += 'text';
        text.appendChild(document.createTextNode(message));
        textWrapper.appendChild(text);
        messageElem.appendChild(avatar);
        messageElem.appendChild(textWrapper);
        document.getElementById('messages').appendChild(messageElem);
    }
</script>

