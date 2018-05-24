<?php

use yii\db\Migration;

/**
 * Handles the creation of table `lcm_users`.
 */
class m180524_072827_create_lcm_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('lcm_users', [
            'user_id' => $this->primaryKey(),
            'user_ad' => $this->string(255),
            'user_name' => $this->string(50),
            'creation_time' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('lcm_users');
    }
}
