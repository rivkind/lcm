<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

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
            'node_name' => Yii::t( 'header_table', 'node_id'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(Items::className(), ['node_id' => 'node_id']);
    }

    public static function allNode(){
        return ArrayHelper::map(self::find()->orderBy('node_name')->all(),'node_id','node_name');
    }
}
