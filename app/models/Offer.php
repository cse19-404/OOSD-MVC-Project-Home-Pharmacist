<?php 

class Offer extends Model{
    
    public function __construct()
    {
        $table = 'seasonaloffertable';
        parent::__construct($table);
    }

    public function deleteOffer($id){
        $this->update($id,['status'=> 1]);
    }

    public function getLastId(){
        return $this->_db->lastId();
    }




}