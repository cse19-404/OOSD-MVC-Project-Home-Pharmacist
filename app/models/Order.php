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
}