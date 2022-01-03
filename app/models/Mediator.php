<?php 

class Mediator extends Model{

    public function __construct()
    {
        $table = 'mediatortable';
        parent::__construct($table);
    }

    public function saveMessage($params,$to,$from){
        $params['sender_username'] = $from;
        $params['receiver_username'] = $to;
        $params['message_type'] = 'text';
        $params['message_ref_id'] = 'None';
        $params['is_read'] = 0;
        $this->assign($params);
        $this->save(); 

    }

    public function findAllMessages($receiver){
        return $this->find(['conditions'=>'receiver_username=? AND message_type=?','bind' => [$receiver,'text']]);
    }

    public function getMessage($id){
        return $this->find(['conditions'=>'id=?','bind' => [$id]]);
    }

    public function markAsRead($id){
        $this->update($id, ['is_read'=>1]);
    }

    public function receiveSeasonalOffers($mode,$OfferId,$from,$msg){
        $params=[];
        if ($mode === 'edit') {
            $params['subject'] = 'Seasonal Offer Edited';
            $params['message'] = 'Seasonal Offer was edited by "'.$this->getPharmacyNamebyUsername($from) . '"  - '.$msg;
        }
        if ($mode === 'new') {
            $params['subject'] = 'Seasonal Offer Added';
            $params['message'] = 'New Seasonal Offer was added by "'. $this->getPharmacyNamebyUsername($from). '" ';           
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
        $results = $this->find(['conditions'=>'receiver_username=?','bind' => ['All-Users']]);
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
        $result = $this->_db->find('prefilledformtable',['conditions'=>'id=?','bind' => [$message_ref_id]]);
        $from = $this->getPharmacyUsernamefromID($result[0]->pharmacy_id);
        $params=[];
        $params['subject'] = 'Pre-Filled Form Recieved';
        if ($mode === 'pharmacy') {
            $params['message'] = 'Pre-Filled Form created and sent by "'. $this->getPharmacyNamebyUsername($from). '" as for your request';            
        }
        if($mode === 'prescription'){
            $params['message'] = 'Pre-Filled Form was sent by "'. $this->getPharmacyNamebyUsername($from). '" for the prescription you sent.';
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
        return $this->find(['conditions'=>'receiver_username=? AND message_type=?','bind' => [$receiver,'prefilled form']]);
    }

    public function receiveOrderStatusUpdate($message_ref_id,$status){
        $result = $this->_db->find('ordertable',['conditions'=>'id=?','bind' => [$message_ref_id]]);
        $from = $this->getPharmacyUsernamefromID($result[0]->pharmacy_id);
        $params=[];
        $params['subject'] = 'Order Status Updated';
        $params['message'] = 'The Order you made at "'. $this->getPharmacyNamebyUsername($from). '" has changed the status of your order. The status of your order is "'.$status.'".';            
        $params['sender_username'] = $from;
        $params['receiver_username'] = $this->getCustomerUsernamefromID($result[0]->customer_id);
        $params['message_type'] = 'order';
        $params['message_ref_id'] = $message_ref_id;
        $params['is_read'] = 0;
        $this->assign($params);
        $this->save();    
    }

    public function findAllOrder($receiver){
        return $this->find(['conditions'=>'receiver_username=? AND message_type=?','bind' => [$receiver,'order']]);
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

    private function getCustomerUsernamefromID($id){
        $result = $this->_db->find('usertable',['conditions'=>'id=?','bind' => [$id]]);
        return $result[0]->username;
    }

    private function getDescriptionfromOffer($message_ref_id){
        $result = $this->_db->find('offertable',['conditions'=>'id=?','bind' => [$message_ref_id]]);
        return $result[0]->description;
    }

}