<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lcm_node".
 *
 * @property int $node_id
 * @property string $node_name
 *
 * @property LcmItems[] $lcmItems
 */
class Node extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lcm_node';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['node_name'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'node_id' => 'Node ID',
            'node_name' => 'Node Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLcmItems()
    {
        return $this->hasMany(LcmItems::className(), ['node_id' => 'node_id']);
    }
}
