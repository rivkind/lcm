<?php

use yii\db\Migration;

/**
 * Handles the creation of table `lcm_logValue`.
 */
class m180531_132409_create_lcm_logValue_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('lcm_logValue', [
            'logId' => $this->primaryKey(),
            'log_id' => $this->integer()->defaultValue(0),
            'log_value' => $this->string(255)->notNull(),
            'prev_value' => $this->text(),
            'current_value' => $this->text(),
        ]);

        $this->addForeignKey('logValue_to_log','lcm_logValue','log_id','lcm_log','log_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('lcm_logValue');
    }
}
