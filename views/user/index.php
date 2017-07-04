<?php if (count($users)): ?>
    <?php foreach ($users as $user): ?>
        <div class="well">
            <h3><?= $user->name ?></h3>
        </div>
    <?php endforeach ?>
<?php endif ?>
