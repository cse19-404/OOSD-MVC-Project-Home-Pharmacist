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

}