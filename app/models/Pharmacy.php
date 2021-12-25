<?php 

class Pharmacy extends Model{
    private $_sessionName;
    public static $currentLoggedInPharmacy = null;

     public function __construct()
    {
        $table = 'pharmacytable';
        parent::__construct($table);
        $this->_sessionName = CURRENT_USER_SESSION_NAME;
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
    public function login(){
        Session::set($this->_sessionName, $this->id);
        Session::set('role','pharmacy');
        Session::set('username',$this->username);
        self::$currentLoggedInPharmacy = $this;
    }

    public function logout(){
        Session::delete(CURRENT_USER_SESSION_NAME);
        self::$currentLoggedInPharmacy = null;
        return true;
    }

}