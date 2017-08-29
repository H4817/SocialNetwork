<?php
use yii\widgets\ListView;

$this->registerJsFile('js/article.js', ['position' => yii\web\View::POS_END]);
$this->registerJsFile('js/comment.js', ['position' => yii\web\View::POS_END]);
?>

<?php \yii\widgets\Pjax::begin(['timeout' => 5000]); ?>
<?php echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_article',
    'viewParams' => ['commentsProvider' => $commentsProvider, 'comment' => $comment]
]);
?>
<?php \yii\widgets\Pjax::end(); ?>

