<?php

use yii\db\Migration;

/**
 * Handles the creation of table `passwordRecovery`.
 */
class m170710_070232_create_passwordRecovery_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('passwordRecovery', [
            'passwordRecoveryId' => $this->primaryKey(),
            'userId' => $this->integer(),
            'token' => $this->string(),
            'date' => $this->dateTime()
        ]);
        $this->addForeignKey('FK-passwordRecovery-userId-user-userId', 'passwordRecovery', 'userId', 'user', 'userId');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('passwordRecovery');
    }
}
