<?php if (!empty($users)): ?>
    <?php foreach ($users->each() as $user): ?>
        <div class="well">
            <a href="<?= Yii::$app->urlManager->createAbsoluteUrl(['user/display',
                'userId' => $user['userId']]) ?>"><?= $user['name'] ?></a>
        </div>
    <?php endforeach ?>
<?php endif ?>

