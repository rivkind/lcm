<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lcm_network".
 *
 * @property int $network_id
 * @property string $network_name
 *
 * @property LcmItems[] $lcmItems
 */
class Network extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lcm_network';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['network_name'], 'string', 'max' => 50],
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
    public function getLcmItems()
    {
        return $this->hasMany(LcmItems::className(), ['network_id' => 'network_id']);
    }
}
