<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

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
 * @property int $updated_at
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

    const DATE_NOT_AVAILABLE = 'NA';
    const DATE_TBD = 'TBD';
    const VALUE_NOT_AVAILABLE = 0;
    const VALUE_TBD = -1;
    const STATUS_DATE_SUCCESS = 'success';
    const STATUS_DATE_DEFAULT = 'default';
    const STATUS_DATE_DANGER = 'danger';
    const STATUS_DATE_WARNING = 'warning';
    const STATUS_DATE_INFO = 'info';

    public $changes;
    public $attach;

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),

        ];
    }

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
            [['network_id', 'node_id', 'vendor_id', 'type_id', 'general_availability', 'date_marketing', 'date_spare_parts', 'date_full_support', 'date_service', 'date_spms', 'status_id'], 'filter', 'filter' => 'intval'],
            [['network_id', 'node_id', 'vendor_id', 'type_id', 'status_id'], 'integer'],
            [['item_description'], 'string'],
            [['network_id','user_resp', 'user_owner', 'node_id', 'vendor_id','hw_type', 'product_name','type_id'], 'required','message'=>'Поле должно быть заполнено'],
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
            'user_resp' => 'Responsible for planning',
            'user_owner' => 'Technical owner',
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

    public static function getQuarter($date)
    {
        if ($date == self::VALUE_TBD) return self::DATE_TBD;
        else if ($date != self::VALUE_NOT_AVAILABLE) return date('y', $date) . "Q" . (ceil(date('n', $date) / 3));
        else return self::DATE_NOT_AVAILABLE;
    }

    public static function getQuarterToTime($q)
    {
        if ($q == self::DATE_NOT_AVAILABLE) return 0;
        else if ($q == self::DATE_TBD) return -1;
        else {
            $p = explode("Q", $q);
            return strtotime("20" . $p[0] . "-" . ($p[1] * 3) . "-30");
        }
    }

    public function getQuarterClass($date)
    {
        if ($date == self::VALUE_TBD) return self::STATUS_DATE_SUCCESS;
        else if ($date != self::VALUE_NOT_AVAILABLE) {
            $days = ($date - time()) / (24 * 60 * 60);
            if ($days == 0) return self::STATUS_DATE_DEFAULT;
            else if ($days < 90) return self::STATUS_DATE_DANGER;
            else if ($days < 180) return self::STATUS_DATE_WARNING;
            else if ($days < 365) return self::STATUS_DATE_INFO;
            else return self::STATUS_DATE_SUCCESS;
        } else return self::STATUS_DATE_DEFAULT;
    }

    public static function allListQuater()
    {
        $sy = date('y', time());
        $q[self::DATE_NOT_AVAILABLE] = self::DATE_NOT_AVAILABLE;
        $q[self::DATE_TBD] = self::DATE_TBD;
        for ($i = ($sy - 15); $i < ($sy + 15); $i++) {
            for ($j = 1; $j < 5; $j++) {
                if ($i < 10) $q["0" . $i . "Q" . $j] = "0" . $i . "Q" . $j;
                else $q[$i . "Q" . $j] = $i . "Q" . $j;

            }
        }
        return $q;
    }

    public static function getItemInfo($id)
    {
        $item = self::find()
            ->where(['item_id' => $id])
            ->one();
        $item->general_availability = self::getQuarter($item->general_availability);
        $item->date_marketing = self::getQuarter($item->date_marketing);
        $item->date_spare_parts = self::getQuarter($item->date_spare_parts);
        $item->date_full_support = self::getQuarter($item->date_full_support);
        $item->date_service = self::getQuarter($item->date_service);
        $item->date_spms = self::getQuarter($item->date_spms);
        return $item;
    }

    public static function getItemNew()
    {
        $item = new self;
        //echo Yii::$app->user->username;
        $user_item = User::getUsernameCN(Yii::$app->user->identity->username);
        $item->user_resp = $user_item;
        $item->user_owner = $user_item;

        return $item;
    }
    public function beforeValidate()
    {
        if (parent::beforeValidate()) {
            $this->general_availability =  self::getQuarterToTime($this->general_availability);
            $this->date_marketing = self::getQuarterToTime($this->date_marketing);
            $this->date_spare_parts = self::getQuarterToTime($this->date_spare_parts);
            $this->date_full_support = self::getQuarterToTime($this->date_full_support);
            $this->date_service = self::getQuarterToTime($this->date_service);
            $this->date_spms = self::getQuarterToTime($this->date_spms);

            return true;
        }
        return false;

    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {

            $data_changes = [];
            $changed_attributes = array_diff_assoc($this->getOldAttributes(), $this->getAttributes());
            foreach($changed_attributes as $key=>$atr){
                if($key!='updated_at'){
                    $data_changes[] = array($key,$this->OldAttributes[$key],$this->attributes[$key]);
                }
            }


            $this->changes = $data_changes;
            return parent::beforeSave($insert);
        } else {
            return false;
        }
    }

    public function afterSave($insert, $changedAttributes) {
        parent::afterSave($insert, $changedAttributes);

        if($this->attach){
            $attach_changes = self::checkAttach($this->item_id,$this->attach);
        }
            if(!$insert) {
                $log_type = Logtype::findOne(['logtype_ident' => 'lcm_edit']);
                Yii::$app->getSession()->setFlash('success', 'Данные обновлены');
            }else{
                $log_type = Logtype::findOne(['logtype_ident' => 'lcm_create']);
                Yii::$app->getSession()->setFlash('success', 'Данные добавлены');
            }


            $log = new Log();
            if($this->isNewRecord){
                $log_type = Logtype::findOne(['logtype_ident' => 'lcm_create']);

            }else{
                $log_type = Logtype::findOne(['logtype_ident' => 'lcm_edit']);
                if($attach_changes){
                    $this->changes = ArrayHelper::merge($this->changes, $attach_changes);
                }

            }
            //echo "<pre>";
            //print_r($this->changes);
            //echo "</pre>";
            if($this->isNewRecord || count($this->changes)>0) {
                $log->logtype_id = $log_type->logtype_id;
                $log->item_id = $this->item_id;

                $log->save();
            }



            if(!$this->isNewRecord && count($this->changes)>0){

                if($attach_changes && count($attach_changes)==count($this->changes)){
                    $this->updated_at = new Expression('NOW()');
                    $this->save();
                }

                $log_value = new LogValue();
                $insert_data = $log_value->prepareInsert($this->changes,$log->log_id);
                Yii::$app->db->createCommand()->batchInsert($log_value->tableName(),$log_value->attributes(), $insert_data)->execute();

                $user_change = User::getUsernameCN(Yii::$app->user->identity->username);

                //отправка оповещения
                if($user_change != $this->user_resp){
                    $email_to[] = User::getUserEmail($this->user_resp);
                }

                if($this->user_resp!=$this->user_owner && $user_change != $this->user_owner){
                    $email_to[] = User::getUserEmail($this->user_owner);
                }




                //$email_to[]="alexey.rivkind@life.com.by";
                $messages = [];
                foreach ($email_to as $m) {
                    if($m){
                        $name_user = User::getNameByEmail($m);
                        $messages[] = Yii::$app->mailer->compose('update_item',['product_name' => $this->product_name,'id'=>$this->item_id,'name_user'=>$name_user])
                            ->setTo($m)
                            ->setSubject('Тема сообщения');
                            //->setTextBody('Текст сообщения')
                            //->send();

                        //$messages[] = Yii::$app->mailer->compose('update_item')
                        //    ->setFrom('job-lcm@life.com.by')
                        //    ->setSubject('Message subject')
                        //    ->setTo($m);
                    }

                }
                Yii::$app->mailer->sendMultiple($messages);
                //echo $email_resp."-".$email_owner;

            }






    }

    private static function checkAttach($id,$attach){
        //$attach_changes = [];
        $attach_old = ItemsToAttachment::find()
            ->select(["attachment_id"])
            ->where(['item_id'=> $id])
            ->all();

        $attach_old = ArrayHelper::getColumn($attach_old, 'attachment_id');

        foreach ($attach_old as $ao){
            if (($attach && !ArrayHelper::isIn($ao, $attach)) || !$attach){
                $attach_delete = ItemsToAttachment::findOne(["attachment_id" => $ao]);

                $attach_delete->delete();
                $attach_changes[] = array('attach_deleted',null,$ao);
            }
        }

        foreach ($attach as $attach){
            if (($attach_old && !ArrayHelper::isIn($attach,$attach_old)) || !$attach_old){
                $rows[] = [
                    'item_id' => $id,
                    'attachment_id' => $attach
                ];
                $attach_changes[] = array('attach_added',null,$attach);
            }

        }
        if($rows){
            $new_attachment = new ItemsToAttachment();
            Yii::$app->db->createCommand()->batchInsert($new_attachment->tableName(),$new_attachment->attributes(), $rows)->execute();
        }


        return $attach_changes;
    }

    public function checkUpdate(){
        $st = strtotime(date("Y-m-d",$this->updated_at));
        $now_time = Yii::$app->formatter->asTimestamp(date('Y-d-m h:i:s'));
        if((($now_time-$st)/(24*60*60)) != Yii::$app->params['updateTime']) {
            return true;
        }
        return false;
    }

    public function timeUpdate(){
        $this->updated_at = Yii::$app->formatter->asTimestamp(date('Y-d-m h:i:s'));
        $this->save();
        $log_type = Logtype::findOne(['logtype_ident' => 'lcm_update']);
        $log = new Log();
        $log->logtype_id = $log_type->logtype_id;
        $log->item_id = $this->item_id;
        $log->save();
        return true;
    }

    public static function filterItems($data){
        $items = Items::find()
            ->joinWith(['network', 'node', 'vendor', 'status', 'type']);
        if($data["r"]){$items = $items->andFilterWhere(['like', 'user_resp', $data["r"]]);}
        if($data["ow"]){$items = $items->andFilterWhere(['like', 'user_owner', $data["ow"]]);}
        if($data["n"]){$items = $items->andFilterWhere(['like', 'network_name', $data["n"]]);}
        if($data["nd"]){$items = $items->andFilterWhere(['like', 'node_name', $data["nd"]]);}
        if($data["v"]){$items = $items->andFilterWhere(['like', 'vendor_name', $data["v"]]);}
        if($data["t"]){$items = $items->andFilterWhere(['like', 'type_name', $data["t"]]);}
        if($data["hw"]){$items = $items->andFilterWhere(['like', 'hw_type', $data["hw"]]);}
        if($data["p"]){$items = $items->andFilterWhere(['like', 'product_name', $data["p"]]);}
        if($data["pt"]){$items = $items->andFilterWhere(['like', 'product_type', $data["pt"]]);}
        if($data["b"]){$items = $items->andFilterWhere(['like', 'bom_code', $data["b"]]);}
        if($data["d"]){$items = $items->andFilterWhere(['like', 'item_description', $data["d"]]);}
        if($data["s"]){$items = $items->andFilterWhere(['like', 'status_name', $data["s"]]);}
        return $items->all();

    }

}
