<?php 

class Order extends Model
{

    public function __construct()
    {
        $table = 'ordertable';
        parent::__construct($table);
    }

    public function getfilteredData($status=''){
        $pharmId = Pharmacy::currentLoggedInPharmacy()->id;
        if ($status===""){
            return $this->find([
                'conditions'=>'closed=? and pharmacy_id=?',
                'bind'=>[0,$pharmId]
            ]);
        }
        return $this->find([
            'conditions'=>'status=? and closed=? and pharmacy_id=?',
            'bind'=>[$status,0,$pharmId]
        ]);
    }

    public function getCustomerOrdersByFilter($status=''){
        $customer_id = User::currentLoggedInUser()->id;
        if ($status===""){
            return $this->find([
                'conditions'=>'deleted=? and closed=? and customer_id=?',
                'bind'=>[0,0,$customer_id]
            ]);
        }
        return $this->find([
            'conditions'=>'status=? and deleted=? and closed=? and customer_id=?',
            'bind'=>[$status,0,0,$customer_id]
        ]);
    }

    public function getLastId()
    {
        return $this->_db->lastId();
    }
}