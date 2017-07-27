<?php

use yii\db\Migration;

/**
 * Handles the creation of table `comment`.
 */
class m170726_100134_create_comment_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('comment', [
            'commentId' => $this->primaryKey(),
            'postId' => $this->integer(),
            'userId' => $this->integer(),
            'message' => $this->string(),
            'date' => $this->dateTime()
        ]);
        $this->addForeignKey('FK-comment-postId-post-postId', 'comment', 'postId', 'post', 'postId');
        $this->addForeignKey('FK-comment-userId-user-userId', 'comment', 'userId', 'user', 'userId');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('comment');
    }
}
