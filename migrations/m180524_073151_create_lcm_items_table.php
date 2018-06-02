<?php

use yii\db\Migration;

/**
 * Handles the creation of table `lcm_items`.
 */
class m180524_073151_create_lcm_items_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('lcm_items', [
            'item_id' => $this->primaryKey(),
            'user_resp' => $this->string(50),
            'user_owner' => $this->string(50),
            'network_id' => $this->integer()->defaultValue(0),
            'node_id' => $this->integer()->defaultValue(0),
            'vendor_id' => $this->integer()->defaultValue(0),
            'type_id' => $this->integer()->defaultValue(0),
            'hw_type' => $this->string(),
            'product_name' => $this->string(),
            'product_type' => $this->string(),
            'item_description' => $this->text(),
            'bom_code' => $this->string(),
            'general_availability' => $this->integer()->defaultValue(0),
            'date_marketing' => $this->integer()->defaultValue(0),
            'date_spare_parts' => $this->integer()->defaultValue(0),
            'date_full_support' => $this->integer()->defaultValue(0),
            'date_service' => $this->integer()->defaultValue(0),
            'date_spms' => $this->integer()->defaultValue(0),
            'status_id' => $this->integer()->defaultValue(1),
        ]);

        $this->createIndex('idx-items-network_id','lcm_items','network_id');
        $this->createIndex('idx-items-node_id','lcm_items','node_id');
        $this->createIndex('idx-items-vendor_id','lcm_items','vendor_id');
        $this->createIndex('idx-items-type_id','lcm_items','type_id');
        $this->createIndex('idx-items-status_id','lcm_items','status_id');

        $this->addForeignKey('item_to_network','lcm_items','network_id','lcm_network','network_id');
        $this->addForeignKey('item_to_node','lcm_items','node_id','lcm_node','node_id');
        $this->addForeignKey('item_to_vendor','lcm_items','vendor_id','lcm_vendor','vendor_id');
        $this->addForeignKey('item_to_type','lcm_items','type_id','lcm_type','type_id');
        $this->addForeignKey('item_to_status','lcm_items','status_id','lcm_status','status_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('lcm_items');
    }
}
