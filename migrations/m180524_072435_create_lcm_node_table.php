<?php

use yii\db\Migration;

/**
 * Handles the creation of table `lcm_node`.
 */
class m180524_072435_create_lcm_node_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('lcm_node', [
            'node_id' => $this->primaryKey(),
            'node_name' => $this->string(50),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('lcm_node');
    }
}
