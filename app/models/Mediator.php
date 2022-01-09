<?php 

class Mediator extends Model{

    public function __construct()
    {
        $table = 'mediatortable';
        parent::__construct($table);
    }

    public function saveMessage($params,$to,$from){
        date_default_timezone_set('Asia/Colombo');
        $params['sender_username'] = $from;
        $params['receiver_username'] = $to;
        $params['message_type'] = 'text';
        $params['message_ref_id'] = 'None';
        $params['is_read'] = 0;
        $params['subject'] = $params['subject'].' - '.date("Y-m-d"). ' - '. date("h:i:sa");
        $this->assign($params);
        $this->save(); 

    }

    public function findAllMessages($receiver){
        return $this->find([
            'conditions'=>'receiver_username=? AND message_type=?',
            'order'=>'is_read ASC',
            'bind' => [$receiver,'text']]);
    }

    public function getMessage($id){
        return $this->find(['conditions'=>'id=?','bind' => [$id]]);
    }

    public function markAsRead($id){
        $this->update($id, ['is_read'=>1]);
    }

    public function receiveSeasonalOffers($mode,$OfferId,$from,$msg){
        date_default_timezone_set('Asia/Colombo');
        $params=[];
        if ($mode === 'edit') {
            $params['subject'] = 'Seasonal Offer Edited';
            $params['message'] = 'Seasonal Offer was edited by "'.$this->getPharmacyNamebyUsername($from) . '" on '.date("Y-m-d"). ' at '. date("h:i:sa").'. - '.$msg;
        }
        if ($mode === 'new') {
            $params['subject'] = 'Seasonal Offer Added';
            $params['message'] = 'New Seasonal Offer was added by "'. $this->getPharmacyNamebyUsername($from).'" on '.date("Y-m-d"). ' at '. date("h:i:sa").'.';           
        }

        $params['sender_username'] = $from;
        $params['receiver_username'] = 'All-Users';
        $params['message_type'] = 'seasonal offer';
        $params['message_ref_id'] = $OfferId;
        $params['is_read'] = 0;
        $this->assign($params);
        $this->save();
    }

    public function findAllOffer(){
        $results = $this->find(['conditions'=>'receiver_username=?','order'=>'is_read ASC','bind' => ['All-Users']]);
        $offers=[];
        foreach($results as $res){
            $params = [];
            $params['sender_username'] = $res->sender_username;
            $params['pharmacy_id'] = $this->getPharmacyIdfromUsername($res->sender_username);
            $params['description'] = $this->getDescriptionfromOffer($res->message_ref_id);
            $params['subject'] = $res->subject;
            $params['message'] = $res->message;
            $params['message_type'] = $res->message_type;
            $offers[] = $params;
        }
        return $offers;
    }

    public function receivePrefilledForms($message_ref_id,$mode){
        date_default_timezone_set('Asia/Colombo');
        $result = $this->_db->find('prefilledformtable',['conditions'=>'id=?','bind' => [$message_ref_id]]);
        $from = $this->getPharmacyUsernamefromID($result[0]->pharmacy_id);
        $params=[];
        $params['subject'] = 'Pre-Filled Form Recieved';
        if ($mode === 'pharmacy') {
            $params['message'] = 'Pre-Filled Form created and sent by "'. $this->getPharmacyNamebyUsername($from). '" as for your request on '.date("Y-m-d"). ' at '. date("h:i:sa").'. ';            
        }
        if($mode === 'prescription'){
            $params['message'] = 'Pre-Filled Form was sent by "'. $this->getPharmacyNamebyUsername($from). '" on '.date("Y-m-d"). ' at '. date("h:i:sa").' for the prescription you sent on '.$result[0]->sent_date.'.';
        }
        $params['sender_username'] = $from;
        $params['receiver_username'] = $this->getCustomerUsernamefromID($result[0]->customer_id);
        $params['message_type'] = 'prefilled form';
        $params['message_ref_id'] = $message_ref_id;
        $params['is_read'] = 0;
        $this->assign($params);
        $this->save();
    }

    public function findAllPreFilledForms($receiver){
        return $this->find(['conditions'=>'receiver_username=? AND message_type=?','order'=>'is_read ASC','bind' => [$receiver,'prefilled form']]);
    }

    public function receiveOrderStatusUpdate($message_ref_id,$status){
        date_default_timezone_set('Asia/Colombo');
        $result = $this->_db->find('ordertable',['conditions'=>'id=?','bind' => [$message_ref_id]]);
        $from = $this->getPharmacyUsernamefromID($result[0]->pharmacy_id);
        $params=[];
        if ($status === 'seen') {
            $params['subject'] = 'Order Accepted'; 
            $params['message'] = 'The Order you made at "'. $this->getPharmacyNamebyUsername($from). '" has been accepted. Your order was confirmed on '.date("Y-m-d"). ' at '. date("h:i:sa").'.';                    
        }
        else{
            $params['subject'] = 'Order Status Updated';
            $params['message'] = 'The Order you made at "'. $this->getPharmacyNamebyUsername($from). '" has changed the status of your order on '.date("Y-m-d"). ' at '. date("h:i:sa").'. The status of your order is "'.$status.'".';            
        }
        
        $params['sender_username'] = $from;
        $params['receiver_username'] = $this->getCustomerUsernamefromID($result[0]->customer_id);
        $params['message_type'] = 'order';
        $params['message_ref_id'] = $message_ref_id;
        $params['is_read'] = 0;
        $this->assign($params);
        $this->save();    
    }

    public function findAllOrder($receiver){
        return $this->find(['conditions'=>'receiver_username=? AND message_type=?','order'=>'is_read ASC','bind' => [$receiver,'order']]);
    }

    public function confirmOrder($message_ref_id){
        date_default_timezone_set('Asia/Colombo');
        $result = $this->_db->find('ordertable',['conditions'=>'id=?','bind' => [$message_ref_id]]);
        $from = $this->getCustomerUsernamefromID($result[0]->customer_id);
        $params=[];
                
        $params['subject'] = 'New Order';
        $params['message'] = 'A new Order is made by "'.$this->getCustomerNamebyUsername($from). '" at your pharamcy on '.date("Y-m-d"). ' at '. date("h:i:sa").'. You can view new order details and accept the order now.';            

        $params['sender_username'] = $from;
        $params['receiver_username'] = $this->getPharmacyUsernamefromID($result[0]->pharmacy_id); 
        $params['message_type'] = 'order';
        $params['message_ref_id'] = $message_ref_id;
        $params['is_read'] = 0;
        $this->assign($params);
        $this->save(); 
    }

    private function getPharmacyIdfromUsername($username){
        $result = $this->_db->find('pharmacytable',['conditions'=>'username=?','bind' => [$username]]);
        return $result[0]->id;
    }

    private function getPharmacyUsernamefromID($id){
        $result = $this->_db->find('pharmacytable',['conditions'=>'id=?','bind' => [$id]]);
        return $result[0]->username;
    }

    private function getPharmacyNamebyUsername($username){
        $result = $this->_db->find('pharmacytable',['conditions'=>'username=?','bind' => [$username]]);
        return $result[0]->name;       
    }

    private function getCustomerNamebyUsername($username){
        $result = $this->_db->find('usertable',['conditions'=>'username=?','bind' => [$username]]);
        return $result[0]->name;       
    }

    private function getCustomerUsernamefromID($id){
        $result = $this->_db->find('usertable',['conditions'=>'id=?','bind' => [$id]]);
        return $result[0]->username;
    }

    private function getDescriptionfromOffer($message_ref_id){
        $result = $this->_db->find('offertable',['conditions'=>'id=?','bind' => [$message_ref_id]]);
        return $result[0]->description;
    }

}