<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lcm_vendor".
 *
 * @property int $vendor_id
 * @property string $vendor_name
 *
 * @property LcmItems[] $lcmItems
 */
class Vendor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lcm_vendor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['vendor_name'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'vendor_id' => 'Vendor ID',
            'vendor_name' => 'Vendor Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLcmItems()
    {
        return $this->hasMany(LcmItems::className(), ['vendor_id' => 'vendor_id']);
    }
}
