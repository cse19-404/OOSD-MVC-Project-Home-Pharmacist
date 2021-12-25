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
        Session::set('role',$this->role);
        Session::set('username',$this->username);
        self::$currentLoggedInUser = $this;
    }

    public function logout(){
        Session::delete(CURRENT_USER_SESSION_NAME);
        self::$currentLoggedInUser = null;
        return true;
    }

    public function registerNewUser($params){
        $this->assign($params);
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        $this->save();
    }

    public function findAllApplications(){
        return $this->_db->find('applicationtable',['conditions'=>'deleted=?','bind' => [0]]);
    }

    public function findApprovedApplications(){
        return $this->_db->find('applicationtable',['conditions'=>'deleted=? AND application_status=? AND acc_created=?','bind' => [0, 'approved', 0]]);
    }
        public function findAllUsers(){
        return $this->_db->find('usertable',['conditions'=>'role=?','bind' => ['customer']]);
    }

    public function findAllPharmacies(){
        return $this->_db->find('pharmacytable');
    }
}
