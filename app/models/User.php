<?php

class User extends Model
{
    private $_isLoggedIn, $_sessionName;
    public static $currentLoggedInUser = null;

    public function __construct($user = '')
    {
        $table = 'usertable';
        parent::__construct($table);
        $this->_sessionName = CURRENT_USER_SESSION_NAME;
        // if ($user != '') {
        //     if (is_int($user)) {
        //         $u = $this->_db->findFirst('users', ['conditions' => 'id=?', 'bind' => [$user]]);
        //     } else {
        //         $u = $this->_db->findFirst('users', ['conditions' => 'username=?', 'bind' => [$user]]);
        //     }
        // }
        // if ($u) {
        //     foreach ($u as $key => $value) {
        //         $this->$key = $value;
        //     }
        // }
    }

    public function findByUserName($username)
    {
        $this->findFirst(['conditions' => 'username=?', 'bind' => [$username]]);
    }

    public static function currentLoggedInUser()
    {
        if (!isset(self::$currentLoggedInUser) && Session::exists(CURRENT_USER_SESSION_NAME)) {
            $u = new Pharmacy((int)Session::get(CURRENT_USER_SESSION_NAME));
            self::$currentLoggedInUser = $u;
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
        $this->deleted = 0;
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        $this->save();
    }
}
