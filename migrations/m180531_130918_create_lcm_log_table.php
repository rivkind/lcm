<?php

use yii\db\Migration;

/**
 * Handles the creation of table `lcm_log`.
 */
class m180531_130918_create_lcm_log_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('lcm_log', [
            'log_id' => $this->primaryKey(),
            'logtype_id' => $this->integer()->defaultValue(0),
            'item_id' => $this->integer()->defaultValue(0),
            'user_id' => $this->integer()->defaultValue(0),
            'log_time' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey('log_to_logtype','lcm_log','logtype_id','lcm_logtype','logtype_id');
        $this->addForeignKey('log_to_item','lcm_log','item_id','lcm_items','item_id');
        $this->addForeignKey('log_to_user','lcm_log','user_id','lcm_users','user_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('lcm_log');
    }
}
