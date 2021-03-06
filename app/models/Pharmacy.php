<?php

class Pharmacy extends Model
{
    private $_sessionName;
    public static $currentLoggedInPharmacy = null;

    public function __construct()
    {
        $table = 'pharmacytable';
        parent::__construct($table);
        $this->_sessionName = CURRENT_USER_SESSION_NAME;
    }

    public function registerNewPharmacy($params, $id)
    {
        if (isset($params['delivery_supported']) && $params['delivery_supported'] == "on") {
            $params['delivery_supported'] = 1;
        } else {
            $params['delivery_supported'] = 0;
        }
        $params['is_closed'] = 0;
        $this->assign($params);
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        $this->save();
        $this->_db->update('applicationtable', $id, [
            'acc_created' => 1
        ]);
    }

    public function findByUserName($username)
    {
        $this->findFirst(['conditions' => 'username=?', 'bind' => [$username]]);
    }

    public static function currentLoggedInPharmacy()
    {
        if (!isset(self::$currentLoggedInPharmacy) && Session::exists(CURRENT_USER_SESSION_NAME)) {
            $user = new Pharmacy();
            $user->findByUserName(Session::get('username'));
            self::$currentLoggedInPharmacy = $user;
        }
        return self::$currentLoggedInPharmacy;
    }
    public function login()
    {
        Session::set($this->_sessionName, $this->id);
        Session::set('role', 'pharmacy');
        Session::set('username', $this->username);
        Session::set('multiton', []);
        self::$currentLoggedInPharmacy = $this;
        date_default_timezone_set('Asia/Colombo');
    }

    public function logout()
    {
        Session::delete();
        self::$currentLoggedInPharmacy = null;
        return true;
    }

    public function findAllItems()
    {
        return $this->_db->find('itemtable', ['conditions' => 'pharmacy_id=? AND status=?', 'bind' => [$this->id, 0]]);
    }

    public function getavailabity($items)
    {
        $results = $this->findAllItems();
        $count = 0;
        $price = 0;
        if (!$results || !$items) {
            return [$count, $price];
        }
        foreach ($items as $item => $quantity) {
            foreach ($results as $row) {
                if (str_contains(strtoupper($row->name), strtoupper($item)) && $row->quantity > $quantity && !$row->prescription_needed) {
                    $count += 1;
                    $price += $row->price_per_unit_quantity * $quantity;
                    break;
                }
            }
        }

        return [$count, $price];
    }

    public function findOffers($type)
    {
        if($type==="all"){
            return $this->_db->find('offertable', ['conditions' => 'pharmacy_id=? AND status=?', 'bind' => [$this->id, 0]]);
        }
        
    }

    public function removePharmacyAccount($id){
        $this->_db->update($this->_table,$id,[
            'is_closed'=>1
        ]);
    }

    public function getLastId()
    {
        return $this->_db->lastId();
    }
}
