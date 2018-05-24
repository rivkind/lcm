<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lcm_type".
 *
 * @property int $type_id
 * @property string $type_name
 *
 * @property LcmItems[] $lcmItems
 */
class Type extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lcm_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type_name'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'type_id' => 'Type ID',
            'type_name' => 'Type Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLcmItems()
    {
        return $this->hasMany(LcmItems::className(), ['type_id' => 'type_id']);
    }
}
