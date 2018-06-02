<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%items}}".
 *
 * @property int $item_id
 * @property string $user_resp
 * @property string $user_owner
 * @property int $network_id
 * @property int $node_id
 * @property int $vendor_id
 * @property int $type_id
 * @property string $hw_type
 * @property string $product_name
 * @property string $product_type
 * @property string $item_description
 * @property string $bom_code
 * @property int $general_availability
 * @property int $date_marketing
 * @property int $date_spare_parts
 * @property int $date_full_support
 * @property int $date_service
 * @property int $date_spms
 * @property int $status_id
 *
 * @property Status $status
 * @property Network $network
 * @property Node $node
 * @property Type $type
 * @property Vendor $vendor
 * @property ItemsToAttachment[] $itemsToAttachments
 * @property Log[] $logs
 * @property NotifySend[] $notifySends
 */
class Items extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%items}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['network_id', 'node_id', 'vendor_id', 'type_id', 'general_availability', 'date_marketing', 'date_spare_parts', 'date_full_support', 'date_service', 'date_spms', 'status_id'], 'integer'],
            [['item_description'], 'string'],
            [['user_resp', 'user_owner'], 'string', 'max' => 50],
            [['hw_type', 'product_name', 'product_type', 'bom_code'], 'string', 'max' => 255],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => Status::className(), 'targetAttribute' => ['status_id' => 'status_id']],
            [['network_id'], 'exist', 'skipOnError' => true, 'targetClass' => Network::className(), 'targetAttribute' => ['network_id' => 'network_id']],
            [['node_id'], 'exist', 'skipOnError' => true, 'targetClass' => Node::className(), 'targetAttribute' => ['node_id' => 'node_id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => Type::className(), 'targetAttribute' => ['type_id' => 'type_id']],
            [['vendor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Vendor::className(), 'targetAttribute' => ['vendor_id' => 'vendor_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'item_id' => 'Item ID',
            'user_resp' => 'User Resp',
            'user_owner' => 'User Owner',
            'network_id' => 'Network ID',
            'node_id' => 'Node ID',
            'vendor_id' => 'Vendor ID',
            'type_id' => 'Type ID',
            'hw_type' => 'Hw Type',
            'product_name' => 'Product Name',
            'product_type' => 'Product Type',
            'item_description' => 'Item Description',
            'bom_code' => 'Bom Code',
            'general_availability' => 'General Availability',
            'date_marketing' => 'Date Marketing',
            'date_spare_parts' => 'Date Spare Parts',
            'date_full_support' => 'Date Full Support',
            'date_service' => 'Date Service',
            'date_spms' => 'Date Spms',
            'status_id' => 'Status ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Status::className(), ['status_id' => 'status_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNetwork()
    {
        return $this->hasOne(Network::className(), ['network_id' => 'network_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNode()
    {
        return $this->hasOne(Node::className(), ['node_id' => 'node_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(Type::className(), ['type_id' => 'type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVendor()
    {
        return $this->hasOne(Vendor::className(), ['vendor_id' => 'vendor_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemsToAttachments()
    {
        return $this->hasMany(ItemsToAttachment::className(), ['item_id' => 'item_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLogs()
    {
        return $this->hasMany(Log::className(), ['item_id' => 'item_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotifySends()
    {
        return $this->hasMany(NotifySend::className(), ['item_id' => 'item_id']);
    }

    public function getSurname($name)
    {
        $fio = explode(" ", $name);
        return $fio[0];
    }

    public function getQuarter($date)
    {
        if($date==-1) return "TBD";
        else if($date!=0) return date('y',$date)."Q".(ceil(date('n',$date)/3));
        else return 'NA';
    }

    public function getQuarterClass($date)
    {
        if($date==-1) return "success";
        else if($date!=0){
            $days = ($date-time())/(24*60*60);
            if($days == 0) return "default";
            else if($days < 90) return "danger";
            else if($days < 180) return "warning";
            else if($days < 365) return "info";
            else return "success";
        }
        else return 'default';
    }
}
