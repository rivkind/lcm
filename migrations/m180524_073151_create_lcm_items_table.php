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
            'network_id' => $this->integer(),
            'node_id' => $this->integer(),
            'vendor_id' => $this->integer(),
            'type_id' => $this->integer(),
            'hw_type' => $this->string(),
            'product_name' => $this->string(),
            'product_type' => $this->string(),
            'item_description' => $this->text(),
            'bom_code' => $this->string(),
            'general_availability' => $this->integer(),
            'date_marketing' => $this->integer(),
            'date_spare_parts' => $this->integer(),
            'date_full_support' => $this->integer(),
            'date_service' => $this->integer(),
            'date_spms' => $this->integer(),
            'status_id' => $this->integer(),
        ]);

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
