<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lcm_status".
 *
 * @property int $status_id
 * @property string $status_name
 *
 * @property LcmItems[] $lcmItems
 */
class Status extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lcm_status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status_name'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'status_id' => 'Status ID',
            'status_name' => 'Status Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLcmItems()
    {
        return $this->hasMany(LcmItems::className(), ['status_id' => 'status_id']);
    }
}
