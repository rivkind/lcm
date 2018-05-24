<?php

use yii\db\Migration;

/**
 * Handles the creation of table `lcm_vendor`.
 */
class m180524_072627_create_lcm_vendor_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('lcm_vendor', [
            'vendor_id' => $this->primaryKey(),
            'vendor_name' => $this->string(50),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('lcm_vendor');
    }
}
