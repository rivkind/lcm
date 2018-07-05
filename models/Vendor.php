<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%vendor}}".
 *
 * @property int $vendor_id
 * @property string $vendor_name
 *
 * @property Items[] $items
 */
class Vendor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%vendor}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['vendor_name'], 'required'],
            [['vendor_name'], 'string', 'max' => 50],
            [['vendor_name'], 'unique'],
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
    public function getItems()
    {
        return $this->hasMany(Items::className(), ['vendor_id' => 'vendor_id']);
    }

    public function getPathImages()
    {
        return '@web/images/' . $this->vendor_name . ".png";
    }

    public static function allVendor(){
        return ArrayHelper::map(self::find()->orderBy('vendor_name')->all(),'vendor_id','vendor_name');
    }
}
