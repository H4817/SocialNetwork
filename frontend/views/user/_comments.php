<?php if ($model->postId === $post->postId): ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <strong><?= $model->name ?></strong> <span class="text-muted"><?= $model->date ?></span>
        </div>
        <div class="panel-body"><?= $model->message ?></div>
    </div>
<?php endif ?>
