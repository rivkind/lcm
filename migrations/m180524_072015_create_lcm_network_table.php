<?php

use yii\db\Migration;

/**
 * Handles the creation of table `lcm_network`.
 */
class m180524_072015_create_lcm_network_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('lcm_network', [
            'network_id' => $this->primaryKey(),
            'network_name' => $this->string(50),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('lcm_network');
    }
}
