<li class="message <?= ($model->senderId == \Yii::$app->user->id) ? 'right' : 'left' ?> appeared">
    <div class="avatar"></div>
    <div class="text_wrapper">
        <div class="text"><?= $model->message ?></div>
    </div>
</li>


