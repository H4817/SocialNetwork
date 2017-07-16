<?php

use yii\db\Migration;

/**
 * Handles the creation of table `post`.
 */
class m170716_191008_create_post_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('post', [
            'postId' => $this->primaryKey(),
            'userId' => $this->integer(),
            'content' => $this->string(),
            'imageReference' => $this->string(),
            'date' => $this->dateTime()
        ]);
        $this->addForeignKey('FK-post-userId-user-userId', 'post', 'userId', 'user', 'userId');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('post');
    }
}
