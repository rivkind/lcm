<?php

use yii\db\Migration;

/**
 * Handles the creation of table `lcm_notify`.
 */
class m180531_132939_create_lcm_notify_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('lcm_notify', [
            'notify_id' => $this->primaryKey(),
            'notify_descr' => $this->string(255)->notNull(),
            'notify_name' => $this->string(255)->notNull()->unique(),
            'notify_title' => $this->string(255)->notNull(),
            'notify_tpl' => $this->text()->notNull(),
            'notify_active' => $this->tinyInteger(1)->defaultValue(1),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('lcm_notify');
    }
}
