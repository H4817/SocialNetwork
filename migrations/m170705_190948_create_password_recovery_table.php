<?php

use yii\db\Migration;

/**
 * Handles the creation of table `password_recovery`.
 */
class m170705_190948_create_password_recovery_table extends Migration
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
        $this->addForeignKey('FK-passwordRecovery-userId-user-userId', 'password_recovery', 'user_id', 'user', 'id');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('passwordRecovery');
    }
}
