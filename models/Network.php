<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%network}}".
 *
 * @property int $network_id
 * @property string $network_name
 *
 * @property Items[] $items
 */
class Network extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%network}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['network_name'], 'required'],
            [['network_name'], 'string', 'max' => 50],
            [['network_name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'network_id' => 'Network ID',
            'network_name' => 'Network Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(Items::className(), ['network_id' => 'network_id']);
    }
}
