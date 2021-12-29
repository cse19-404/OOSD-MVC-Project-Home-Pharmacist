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

    public function registerNewPharmacy($params, $id){
        if (isset($params['delivery_supported']) && $params['delivery_supported']=="on"){
            $params['delivery_supported'] = 1;
        }else{
            $params['delivery_supported'] = 0;
        }
        $this->assign($params);
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        $this->save();
        $this->_db->update('applicationtable',$id,[
            'acc_created'=>1
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
    public function login(){
        Session::set($this->_sessionName, $this->id);
        Session::set('role','pharmacy');
        Session::set('username',$this->username);
        Session::set('multiton',[]);
        self::$currentLoggedInPharmacy = $this;
    }

    public function logout(){
        Session::delete(CURRENT_USER_SESSION_NAME);
        Session::delete('role');
        Session::delete('username');
        self::$currentLoggedInPharmacy = null;
        return true;
    }

    public function findAllItems(){
        return $this->_db->find('itemtable',['conditions'=>'pharmacy_id=? AND status=?','bind' => [$this->id,0]]);
    }

}