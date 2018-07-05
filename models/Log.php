<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "{{%log}}".
 *
 * @property int $log_id
 * @property int $logtype_id
 * @property int $item_id
 * @property int $user_id
 * @property int $log_time
 *
 * @property User $users
 * @property Items $item
 * @property Logtype $logtype
 * @property LogValue[] $logValues
 */
class Log extends \yii\db\ActiveRecord
{
    public $description;

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => '\yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['log_time'],

                ],
                //'value' => new Expression('NOW()'),
            ],
        ];
    }
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
            [['logtype_id', 'item_id', 'user_id'], 'integer'],
            //[['log_time'], 'required'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id' => 'user_id']],
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
            //'log_time' => 'Log Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
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

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {

            $this->user_id = Yii::$app->user->id;
            return parent::beforeSave($insert);
        } else {
            return false;
        }
    }

    public function getDescription(){
        if($this->logtype->logtype_ident == 'lcm_edit'){
            $log_values = LogValue::find()->where(['log_id' => $this->log_id])->all();

            return self::prepareDescription($log_values);
        }
        return $this->logtype->logtype_name;
    }

    private static function prepareDescription($data){
        $txt = '';

        foreach ($data as $d){
            $type = $d->log_value;
            $current = $d->current_value;
            $prev = $d->prev_value;
            if($type == 'general_availability' || $type == 'date_marketing' || $type == 'date_spare_parts' || $type == 'date_full_support' || $type == 'date_service' || $type == 'date_spms'){
                $prev = Items::getQuarter($prev);
                $current = Items::getQuarter($current);
            }else if($type == 'network_id'){
                $network_prev = Network::find()->select(['network_name'])->where(['network_id'=> $prev])->one();
                $prev = $network_prev->network_name;
                $network_current = Network::find()->select(['network_name'])->where(['network_id'=> $current])->one();
                $current = $network_current->network_name;
            }else if($type == 'node_id'){
                $node_prev = Node::find()->select(['node_name'])->where(['node_id'=> $prev])->one();
                $prev = $node_prev->node_name;
                $node_current = Node::find()->select(['node_name'])->where(['node_id'=> $current])->one();
                $current = $node_current->node_name;
            }else if($type == 'vendor_id'){
                $vendor_prev = Vendor::find()->select(['vendor_name'])->where(['vendor_id'=> $prev])->one();
                $prev = $vendor_prev->vendor_name;
                $vendor_current = Vendor::find()->select(['vendor_name'])->where(['vendor_id'=> $current])->one();
                $current = $vendor_current->vendor_name;
            }else if($type == 'status_id'){
                $status_prev = Status::find()->select(['status_name'])->where(['status_id'=> $prev])->one();
                $prev = $status_prev->status_name;
                $status_current = Status::find()->select(['status_name'])->where(['status_id'=> $current])->one();
                $current = $status_current->status_name;
            }else if($type == 'type_id'){
                $type_prev = Type::find()->select(['type_name'])->where(['type_id'=> $prev])->one();
                $prev = $type_prev->type_name;
                $type_current = Type::find()->select(['type_name'])->where(['type_id'=> $current])->one();
                $current = $type_current->type_name;
            }else if($type == 'attach_added' || $type == 'attach_deleted'){
                $attach = Attachment::findOne(["attachment_id" => $current]);
                $current = $attach->attachment_name;
            }
            if($type == 'attach_added' || $type == 'attach_deleted'){
                $txt.="<div>".$type.": <b>".$current."</b></div>";
            }else{
                $txt.="<div>".$type.": <b>".$prev."</b> на <b>".$current."</b></div>";
            }

        }
        return $txt;
    }

}
