<?php

use yii\db\Migration;

/**
 * Handles the creation of table `lcm_type`.
 */
class m180524_072706_create_lcm_type_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('lcm_type', [
            'type_id' => $this->primaryKey(),
            'type_name' => $this->string(50)->notNull()->unique(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('lcm_type');
    }
}
