<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%users}}".
 *
 * @property int $user_id
 * @property string $user_ad
 * @property string $user_name
 * @property int $creation_time
 *
 * @property Attachment[] $attachments
 * @property Log[] $logs
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%users}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_ad'], 'required'],
            [['creation_time'], 'integer'],
            [['user_ad'], 'string', 'max' => 255],
            [['user_name'], 'string', 'max' => 50],
            [['user_ad'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'user_ad' => 'User Ad',
            'user_name' => 'User Name',
            'creation_time' => 'Creation Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttachments()
    {
        return $this->hasMany(Attachment::className(), ['user_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLogs()
    {
        return $this->hasMany(Log::className(), ['user_id' => 'user_id']);
    }
}
