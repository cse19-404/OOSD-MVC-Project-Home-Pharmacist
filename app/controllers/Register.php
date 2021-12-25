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
                        $this->view->render('user/dashboard');
                    }
                }else{
                    $this->PharmacyModel->findByUserName($_POST['username']);
                    if ($this->PharmacyModel && password_verify(Input::get('password'),$this->PharmacyModel->password)){
                        $this->PharmacyModel->login();
                        self::$_role = 'pharmacy';
                        $this->view->render('user/dashboard');
                    }
                }                
            }else {
                $this->view->render('register/login');
                if ($role === 'pharmacy'){
                    echo('<br><a href='.SROOT.'register/signup/pharmacy>Apply For a Pharmacy Account</a>');
                }else{
                    echo('<br><label>Need an account? <a href='.SROOT.'register/signup/customer>Sign up</a></label>');    
                }    
            }
            
        }

        public function logoutAction(){
            if (self::$_role === 'customer'){
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
                        ]
                    ]);

                if ($validation->passed()){
                    $this->UserModel = new User();
                    $this->UserModel->registerNewUser($_POST);
                    $this->UserModel->login();

                    $this->view->render('user/dashboard');
                }else {
                    $this->view->displayErrors = $validation->displayErrors();
                    $this->view->render('register/signup');
                }
                    
                }elseif ($role === 'pharmacy') {
                    $this->ApplicationModel = new Application();
                    $this->ApplicationModel->saveApplication($_POST);

                    $this->view->render('home/index');
                    echo ('<h2>Application succesfully submitted</h2>');
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
