<?php

use yii\db\Migration;

/**
 * Handles the creation of table `lcm_attachment`.
 */
class m180531_125229_create_lcm_attachment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('lcm_attachment', [
            'attachment_id' => $this->primaryKey(),
            'attachment_name' => $this->string(255)->notNull()->unique(),
            'attachment_path' => $this->string(255)->notNull(),
            'attachment_size' => $this->integer(),
            'attachment_key' => $this->string(255)->notNull()->unique(),
            'attachment_descr' => $this->text(),
            'user_id' => $this->integer()->notNull(),
            'creation_time' => $this->integer()->notNull(),
            'isDelete' => $this->tinyInteger(1)->notNull(),
        ]);

        $this->addForeignKey('attachment_to_user','lcm_attachment','user_id','lcm_users','user_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('lcm_attachment');
    }
}