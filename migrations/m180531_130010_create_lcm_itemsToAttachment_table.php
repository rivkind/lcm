<?php

use yii\db\Migration;

/**
 * Handles the creation of table `lcm_itemsToAttachment`.
 */
class m180531_130010_create_lcm_itemsToAttachment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('lcm_itemsToAttachment', [
            'item_id' => $this->integer()->notNull(),
            'attachment_id' => $this->integer()->notNull(),
        ]);

        $this->createIndex('idx-itemsToAttachment-item_id','lcm_itemsToAttachment','item_id');
        $this->createIndex('idx-itemsToAttachment-attachment_id','lcm_itemsToAttachment','attachment_id');

        $this->addForeignKey('attachment_to_item','lcm_itemsToAttachment','item_id','lcm_items','item_id');
        $this->addForeignKey('attachment_to_attach','lcm_itemsToAttachment','attachment_id','lcm_attachment','attachment_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('lcm_itemsToAttachment');
    }
}
