<?php 

class Mediator extends Model{

    public function __construct()
    {
        $table = 'mediatortable';
        parent::__construct($table);
    }

    public function savePharmacyMessage($params,$to,$from){
        $params['sender_username'] = $from;
        $params['receiver_username'] = $to;
        $params['message_type'] = 'text';
        $params['message_ref_id'] = 'None';
        $this->assign($params);
        $this->save(); 

    }

}