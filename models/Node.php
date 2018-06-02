<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%node}}".
 *
 * @property int $node_id
 * @property string $node_name
 *
 * @property Items[] $items
 */
class Node extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%node}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['node_name'], 'required'],
            [['node_name'], 'string', 'max' => 50],
            [['node_name'], 'unique'],
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
    public function getItems()
    {
        return $this->hasMany(Items::className(), ['node_id' => 'node_id']);
    }
}
