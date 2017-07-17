<?php
use common\models\database\Post;
use common\models\database\User;

$allUsers = User::find()->all();
?>
<?php foreach ($allUsers as $concreteUser): ?>
    <h1><?= $concreteUser->name ?></h1>
    <?php $allPosts = Post::findAll([
        'userId' => $concreteUser->userId
    ]); ?>
    <?php foreach ($allPosts as $concretePost): ?>
        <div class="well"><?= $concretePost->content ?> <br> <br>
            <img src="../../common/uploads/<?= $concretePost->imageReference ?>" alt="err" class="img-responsive"> <br>
            <?= $concretePost->date ?>
        </div>
    <?php endforeach; ?>
<?php endforeach; ?>
