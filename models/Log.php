<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%log}}".
 *
 * @property int $log_id
 * @property int $logtype_id
 * @property int $item_id
 * @property int $user_id
 * @property int $log_time
 *
 * @property Users $user
 * @property Items $item
 * @property Logtype $logtype
 * @property LogValue[] $logValues
 */
class Log extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%log}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['logtype_id', 'item_id', 'user_id', 'log_time'], 'integer'],
            [['log_time'], 'required'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'user_id']],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => Items::className(), 'targetAttribute' => ['item_id' => 'item_id']],
            [['logtype_id'], 'exist', 'skipOnError' => true, 'targetClass' => Logtype::className(), 'targetAttribute' => ['logtype_id' => 'logtype_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'log_id' => 'Log ID',
            'logtype_id' => 'Logtype ID',
            'item_id' => 'Item ID',
            'user_id' => 'User ID',
            'log_time' => 'Log Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['user_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Items::className(), ['item_id' => 'item_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLogtype()
    {
        return $this->hasOne(Logtype::className(), ['logtype_id' => 'logtype_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLogValues()
    {
        return $this->hasMany(LogValue::className(), ['log_id' => 'log_id']);
    }


}
