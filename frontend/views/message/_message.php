<li class="message <?= ($model->senderId == \Yii::$app->user->id) ? 'right' : 'left' ?> appeared">
    <img data-name="<?= ($model->senderId ==
        \Yii::$app->user->id) ? $participants['sender'] : $participants['receiver'] ?>" class="avatar"/>
    <div class="text_wrapper">
        <div class="text"><?= $model->message ?></div>
    </div>
</li>


