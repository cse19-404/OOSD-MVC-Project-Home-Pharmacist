<?php

class User extends Model
{
    private $_isLoggedIn, $_sessionName;
    public static $currentLoggedInUser = null;

    public function __construct()
    {
        $table = 'usertable';
        parent::__construct($table);
        $this->_sessionName = CURRENT_USER_SESSION_NAME;
    }

    public function findByUserName($username)
    {
        $this->findFirst(['conditions' => 'username=?', 'bind' => [$username]]);
    }

    public static function currentLoggedInUser()
    {
        if (!(self::$currentLoggedInUser) && Session::exists(CURRENT_USER_SESSION_NAME)) {
            $user = new User();
            $user->findByUserName(Session::get('username'));
            self::$currentLoggedInUser = $user;
        }
        return self::$currentLoggedInUser;
    }

    public function login()
    {
        Session::set($this->_sessionName, $this->id);
        Session::set('role', $this->role);
        Session::set('username', $this->username);
        Session::set('multiton', []);
        self::$currentLoggedInUser = $this;
    }

    public function logout()
    {
        Session::delete();
        self::$currentLoggedInUser = null;
        return true;
    }

    public function registerNewUser($params)
    {
        $params['is_closed'] = 0;
        $this->assign($params);
        $nearbypharmacies = $this->getAllNearByPharmacies($this->latitude, $this->longitude);
        $this->nearbypharmacies = $nearbypharmacies;
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        $this->save();
    }

    public function findAllApplications()
    {
        return $this->_db->find('applicationtable', ['conditions' => 'deleted=?', 'bind' => [0]]);
    }

    public function findApprovedApplications()
    {
        return $this->_db->find('applicationtable', ['conditions' => 'deleted=? AND application_status=? AND acc_created=?', 'bind' => [0, 'approved', 0]]);
    }
    public function findAllUsers()
    {
        return $this->_db->find('usertable', ['conditions' => 'role=?', 'bind' => ['customer']]);
    }

    public function findAllPharmacies()
    {
        return $this->_db->find('pharmacytable');
    }

    public function getAllNearByPharmacies()
    {
        $pharmacies = $this->findAllPharmacies();
        foreach ($pharmacies as $pharmacy) {
            $pharmacy = (array) $pharmacy;
            $distance = distance($this->latitude, $this->longitude, $pharmacy['latitude'], $pharmacy['longitude']);
            $distance_list[$pharmacy['id']] = $distance;
        }
        asort($distance_list);
        foreach ($distance_list as $key => $value) {
            $keys[] = $key;
        }
        $distances = array_slice($keys, 0, 10);

        return (join(',', $distances));
    }

    public function searchPharmacy($pharmName)
    {
        $resPharms = [];
        $results = [];
        $results = $this->findAllPharmacies();
        foreach ($results as $row) {
            if (str_contains(strtoupper($row->name), strtoupper($pharmName))) {
                $resPharms[] = $row;
            }
        }
        return $resPharms;
    }

    public function searchCustomer($name)
    {
        $resCustomers = [];
        $results = [];
        $results = $this->findAllUsers();
        foreach ($results as $row) {
            if (str_contains(strtoupper($row->name), strtoupper($name))) {
                $resCustomers[] = $row;
            }
        }
        return $resCustomers;
    }

    public function findAllOffers()
    {
        return $this->_db->find('offertable');
    }

    public function removeCustomerAccount($id){
        $this->_db->update($this->_table,$id,[
            'is_closed'=>1
        ]);
    }
}
