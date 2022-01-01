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
        return $this->_db->find('mediatortable',['conditions'=>'receiver_username=?','bind' => [$receiver]]);
    }

    public function getMessage($id){
        return $this->_db->find('mediatortable',['conditions'=>'id=?','bind' => [$id]]);
    }

    public function markAsRead($id){
        $this->update($id, ['is_read'=>1]);
    }

    public function receiveSeasonalOffers($mode,$OfferId,$from,$msg){
        $params=[];
        if ($mode === 'edit') {
            $params['subject'] = 'Seasonal Offer Edited';
            $params['message'] = 'Seasonal Offer was edited by " '. $from. ' " Pharmacy - '.$msg;
        }
        if ($mode === 'new') {
            $params['subject'] = 'Seasonal Offer Added';
            $params['message'] = 'New Seasonal Offer was added by " '. $from. ' " Pharmacy';           
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
        $results = $this->_db->find('mediatortable',['conditions'=>'receiver_username=?','bind' => ['All-Users']]);
        $offers=[];
        foreach($results as $res){
            $params = [];
            $params['sender_username'] = $res->sender_username;
            $params['pharmacy_id'] = $this->getPharmacyIdfromOffer($res->sender_username);
            $params['description'] = $this->getDescriptionfromOffer($res->message_ref_id);
            $params['subject'] = $res->subject;
            $params['message'] = $res->message;
            $params['message_type'] = $res->message_type;
            $offers[] = $params;
        }
        return $offers;
    }

    private function getPharmacyIdfromOffer($username){
        $result = $this->_db->find('pharmacytable',['conditions'=>'username=?','bind' => [$username]]);
        return $result[0]->id;
    }

    private function getDescriptionfromOffer($message_ref_id){
        $result = $this->_db->find('offertable',['conditions'=>'id=?','bind' => [$message_ref_id]]);
        return $result[0]->description;
    }

    public function receivePrefilledfromsFromPrescription($refId){
        

    }

}