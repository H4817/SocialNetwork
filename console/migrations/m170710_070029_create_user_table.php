<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m170710_070029_create_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('user', [
            'userId' => $this->primaryKey(),
            'email' => $this->string()->defaultValue(null),
            'passwordHash' => $this->string(),
            'name' => $this->string(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('user');
    }
}
