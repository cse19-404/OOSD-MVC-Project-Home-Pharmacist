<?php 

    class Register extends Controller{

        private static $_role;

        public function __construct($controller,$action)
        {
            parent::__construct($controller,$action);
            $this->load_model('User');
            $this->load_model('Pharmacy');
            $this->load_model('Application');
        }

        public function loginAction($role){
            self::$_role = $role;
            if ($_POST){
                if ($role === 'customer'){
                    $this->UserModel->findByUserName($_POST['username']);
                    if ($this->UserModel && password_verify(Input::get('password'),$this->UserModel->password)){
                        $this->UserModel->login();
                        self::$_role = 'customer';
                        Router::redirect('CustomerDashboard');
                    }else {
                        $this->view->errcreditionals = '<li> Wrong Creditionals </li>';
                        $this->view->render('register/login');
                    }
                }else{
                    $this->PharmacyModel->findByUserName($_POST['username']);
                    if ($this->PharmacyModel && password_verify(Input::get('password'),$this->PharmacyModel->password)){
                        $this->PharmacyModel->login();
                        self::$_role = 'pharmacy';
                        //dnd($GLOBALS['multiton']);
                        Router::redirect('PharmacyDashboard');
                    }else {
                        $this->view->errcreditionals = '<li> Wrong Creditionals </li>';
                        $this->view->render('register/login');
                    }
                }                
            }else {
                $this->view->role=$role;
                $this->view->render('register/login'); 
            }
            
        }

        public function logoutAction(){
            $user = User::currentLoggedInUser();
            if ($user->role === 'customer' || $user->role  === 'super_admin'){
                $this->UserModel->logout();
            }else{
                $this->PharmacyModel->logout();
            }
            
            Router::redirect('home/index');
        }

        public function signupAction($role){
            self::$_role = $role;
            $validation = new Validate();
            if ($_POST){
                if ($role === 'customer'){
                    $validation->check($_POST,[
                        'password'=>[
                            'display'=>'Password',
                            'min'=>6
                        ],
                        'username'=>[
                            'display'=>'Username',
                            'min'=>4
                        ],
                        'repassword'=>[
                            'display'=>'Confirm Password',
                            'matches'=>'password'
                        ],
                        'username'=>[
                            'display'=>'Username',
                            'unique'=>'usertable'
                        ],
                        'latitude'=>[
                            'display'=>'Latitude',
                            'is_numeric'=>true
                        ],
                        'longitude'=>[
                            'display'=>'Longitude',
                            'is_numeric'=>true
                        ],
                        'mobile_number'=>[
                            'display'=>'Mobile Number',
                            'valid_contact'=>true
                        ],
                        'nic'=>[
                            'display'=>'NIC no',
                            'valid_idNo'=>true
                        ]
                    ]);

                    if ($validation->passed()){
                        $this->UserModel = new User();
                        $this->UserModel->registerNewUser($_POST);
                        $this->view->msg='Account Succesfully Created';
                        $this->view->render('home/index');
                    }else {
                        $this->view->displayErrors = $validation->displayErrors();
                        $this->view->render('register/signup');
                    }
                    
                }elseif ($role === 'pharmacy') {
                    $validation->check($_POST,[
                        'latitude'=>[
                            'display'=>'Latitude',
                            'is_numeric'=>true
                        ],
                        'longitude'=>[
                            'display'=>'Longitude',
                            'is_numeric'=>true
                        ],
                        'contact_no'=>[
                            'display'=>'Mobile Number',
                            'valid_contact'=>true
                        ]
                    ]);
                    
                    if ($validation->passed()){
                        $this->ApplicationModel = new Application();
                        $this->ApplicationModel->saveApplication($_POST);
                        $this->view->msg='Application succesfully submitted';
                        $this->view->render('home/index');
                    }else {
                        $this->view->displayErrors = $validation->displayErrors();
                        $this->view->render('register/pharmacyApplication');
                    }
                    
                   
                }
            }else {
                if ($role === 'customer'){
                    $this->view->render('register/signup');
                }elseif ($role === 'pharmacy') {
                    $this->view->render('register/pharmacyApplication');
                }
                
            }
           
            
        }

        public static function getCurrentRole(){
            return self::$_role;
        }
    }
