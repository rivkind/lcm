<?php

use yii\db\Migration;

/**
 * Handles the creation of table `lcm_status`.
 */
class m180524_072536_create_lcm_status_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('lcm_status', [
            'status_id' => $this->primaryKey(),
            'status_name' => $this->string(50)->notNull()->unique(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('lcm_status');
    }
}
