<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\database\Post */

$this->title = 'Update Post: ' . $model->postId;
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->postId, 'url' => ['view', 'id' => $model->postId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="post-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
