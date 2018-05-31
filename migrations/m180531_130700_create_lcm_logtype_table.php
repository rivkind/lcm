<?php

use yii\db\Migration;

/**
 * Handles the creation of table `lcm_logtype`.
 */
class m180531_130700_create_lcm_logtype_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('lcm_logtype', [
            'logtype_id' => $this->primaryKey(),
            'logtype_ident' => $this->string(50)->notNull()->unique(),
            'logtype_name' => $this->string(255)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('lcm_logtype');
    }
}
