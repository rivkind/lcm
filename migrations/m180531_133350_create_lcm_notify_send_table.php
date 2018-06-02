<?php

use yii\db\Migration;

/**
 * Handles the creation of table `lcm_notify_send`.
 */
class m180531_133350_create_lcm_notify_send_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('lcm_notify_send', [
            'id' => $this->primaryKey(),
            'item_id' => $this->integer()->notNull(),
            'name' => $this->string(50)->notNull(),
            'day' => $this->integer()->notNull(),
        ]);

        $this->createIndex('idx-notify_send-item_id','lcm_notify_send','item_id');

        $this->addForeignKey('notifysend_to_item','lcm_notify_send','item_id','lcm_items','item_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('lcm_notify_send');
    }
}
