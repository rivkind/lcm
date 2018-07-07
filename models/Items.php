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
    const STATUS_NOT_ACTIVE = 3;
    const TITLE_GA = 'General Availability';
    const TITLE_MD = 'End Of Marketing Date';
    const TITLE_SPARE = 'Last Order Date of Spare Parts';
    const TITLE_SUPPORT = 'End Of Full Support';
    const TITLE_SPMS = 'Last date can be included in SPMS contract';
    const TITLE_SERVICE = 'End Of Service Date';



    public $changes;
    public $attach;


    private static $data_sender;
    private static $data_send;
    private static $now;
    private static $ns;


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
            'user_resp' => Yii::t( 'header_table', 'user_resp'),
            'user_owner' => Yii::t( 'header_table', 'user_owner'),
            'network_id' => Yii::t( 'header_table', 'network_id'),
            'node_id' => Yii::t( 'header_table', 'node_id'),
            'vendor_id' => Yii::t( 'header_table', 'vendor_id'),
            'type_id' => Yii::t( 'header_table', 'type_id'),
            'hw_type' => Yii::t( 'header_table', 'hw_type'),
            'product_name' => Yii::t( 'header_table', 'product_name'),
            'product_type' => Yii::t( 'header_table', 'product_type'),
            'item_description' => Yii::t( 'header_table', 'item_description'),
            'bom_code' => Yii::t( 'header_table', 'bom_code'),
            'general_availability' => Yii::t( 'header_table', 'general_availability'),
            'date_marketing' => Yii::t( 'header_table', 'date_marketing'),
            'date_spare_parts' => Yii::t( 'header_table', 'date_spare_parts'),
            'date_full_support' => Yii::t( 'header_table', 'date_full_support'),
            'date_service' => Yii::t( 'header_table', 'date_service'),
            'date_spms' => Yii::t( 'header_table', 'date_spms'),
            'status_id' => Yii::t( 'header_table', 'status_id' ),
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
            if($p[1]){
                return strtotime("20" . $p[0] . "-" . ($p[1] * 3) . "-30");
            }
            return $q;
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
                    if($key=='general_availability' || $key=='date_marketing' || $key == 'date_spare_parts' || $key == 'date_full_support' || $key == 'date_service' || $key == 'date_spms'){
                        $notify_item = NotifySend::findOne(['item_id' => $this->item_id, 'name' => $key]);
                        $notify_item->delete();
                    }
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
        $attach_changes = array();
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
            if(isset($email_to)){
                $messages = [];
                foreach ($email_to as $m) {
                    if($m){
                        $name_user = User::getNameByEmail($m);
                        $messages[] = Yii::$app->mailer->compose('update_item',['product_name' => $this->product_name,'id'=>$this->item_id,'name_user'=>$name_user])
                            ->setTo($m)
                            ->setSubject(Yii::t( 'mail_title', 'In LCM record changes have been made'));
                    }

                }
                Yii::$app->mailer->sendMultiple($messages);
            }
        }
    }

    private static function checkAttach($id,$attach){

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
        if((($now_time-$st)/(24*60*60)) >= Yii::$app->params['updateTime']) {
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

    public static function oldItemNotification(){
        $status = Status::findOne(['status_id' => self::STATUS_NOT_ACTIVE]);
        $items = self::find()->where('status_id != :status', ['status'=>$status->status_id])->all();
        foreach ($items as $item){
            if($item->checkUpdate()){
                self::$data_send[$item->user_resp][]=array($item->product_name,$item->item_id);
                self::$data_sender[] = $item->user_resp;
                if($item->user_resp != $item->user_owner){
                    self::$data_send[$item->user_owner][]=array($item->product_name,$item->item_id);
                    self::$data_sender[] = $item->user_owner;
                }

            }
        }

        self::sendMail(Yii::t( 'mail_title', 'LCM event - need your action'),'update_need');
    }

    public static function notifyDeadline(){
        self::$now =  Yii::$app->formatter->asTimestamp(date('Y-d-m'));

        $notify_send = NotifySend::find()->all();

        foreach ($notify_send as $n){
            self::$ns[$n->name][$n->item_id][$n->day]= 1;
        }
        $items = Items::find()->all();
        foreach($items as $item){

            $item->addSender($item->general_availability,'general_availability',self::TITLE_GA);
            $item->addSender($item->date_marketing,'date_marketing',self::TITLE_MD);
            $item->addSender($item->date_spare_parts,'date_spare_parts',self::TITLE_SPARE);
            $item->addSender($item->date_full_support,'date_full_support',self::TITLE_SUPPORT);
            $item->addSender($item->date_service,'date_service',self::TITLE_SERVICE);
            $item->addSender($item->date_spms,'date_spms',self::TITLE_SPMS);

        }

        self::sendMail(Yii::t( 'mail_title', 'LCM Event'),'deadline');
    }

    protected static function sendMail($title,$view){
        if(self::$data_send){
            $result = array_unique(self::$data_sender);
            $data_sender = array_values($result);

            $messages = [];
            foreach($data_sender as $sender){
                $name_user =  User::getNameByCN($sender);
                $email = User::getUserEmail($sender);
                $messages[] = Yii::$app->mailer->compose($view,['data_send' => self::$data_send[$sender],'name_user'=>$name_user])
                    ->setTo($email)
                    ->setSubject($title);
            }
            Yii::$app->mailer->sendMultiple($messages);
        }
    }

    protected function needNotify($type, $d){

        $data = ($d-self::$now)/(24*60*60);

        if($data<=0){if(!isset(self::$ns[$type][$this->item_id][0])) return 0;}
        else if($data>0 && $data<30){if(!isset(self::$ns[$type][$this->item_id][30])) return 30;}
        else if($data>30 && $data<90){if(!isset(self::$ns[$type][$this->item_id][90])) return 90;}
        else if($data>90 && $data<180){if(!isset(self::$ns[$type][$this->item_id][180])) return 180;}
        else if($data>180 && $data<365){if(!isset(self::$ns[$type][$this->item_id][365])) return 365;}

        return -1;
    }

    protected function addSender($item_date,$type,$message){
        if($item_date != self::VALUE_NOT_AVAILABLE && $item_date != self::VALUE_TBD){

            $send = $this->needNotify($type,$item_date);

            if($send !=self::VALUE_TBD){
                self::$data_send[$this->user_resp][]=array($this->product_name,$this->item_id,$send,Yii::t( 'header_table_full_title', $message));
                self::$data_sender[] = $this->user_resp;
                if($this->user_resp != $this->user_owner){
                    self::$data_send[$this->user_owner][]=array($this->product_name,$this->item_id,$send,Yii::t( 'header_table_full_title', $message));
                    self::$data_sender[] = $this->user_owner;
                }
                NotifySend::addNew($this->item_id,$type,$send);
            }
        }
    }

}
