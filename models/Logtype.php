<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%logtype}}".
 *
 * @property int $logtype_id
 * @property string $logtype_ident
 * @property string $logtype_name
 *
 * @property Log[] $logs
 */
class Logtype extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%logtype}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['logtype_ident', 'logtype_name'], 'required'],
            [['logtype_ident'], 'string', 'max' => 50],
            [['logtype_name'], 'string', 'max' => 255],
            [['logtype_ident'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'logtype_id' => 'Logtype ID',
            'logtype_ident' => 'Logtype Ident',
            'logtype_name' => 'Logtype Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLogs()
    {
        return $this->hasMany(Log::className(), ['logtype_id' => 'logtype_id']);
    }
}
