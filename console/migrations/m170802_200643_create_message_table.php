<?php

use yii\db\Migration;

/**
 * Handles the creation of table `message`.
 */
class m170802_200643_create_message_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('message', [
            'messageId' => $this->primaryKey(),
            'senderId' => $this->integer(),
            'receiverId' => $this->integer(),
            'message' => $this->string(),
            'date' => $this->dateTime(),
        ]);
        $this->addForeignKey('FK-message-senderId-user-userId', 'message', 'senderId', 'user', 'userId');
        $this->addForeignKey('FK-message-receiverId-user-userId', 'message', 'receiverId', 'user', 'userId');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('message');
    }
}
