<?php 

    class Register extends Controller{

        private static $_role;

        public function __construct($controller,$action)
        {
            parent::__construct($controller,$action);
            $this->load_model('User');
            $this->load_model('Pharmacy');
        }

        public function loginAction($role){
            self::$_role = $role;
            if ($_POST){
                if ($role === 'customer'){
                    $this->UserModel->findByUserName($_POST['username']);
                    if ($this->UserModel && password_verify(Input::get('password'),$this->UserModel->password)){
                        $this->UserModel->login();
                        $this->view->render('user/dashboard');
                    }
                }else{
                    $this->PharmacyModel->findByUserName($_POST['username']);
                    if ($this->PharmacyModel && password_verify(Input::get('password'),$this->PharmacyModel->password)){
                        $this->PharmacyModel->login();
                        $this->view->render('user/dashboard');
                    }
                }                
            }else {
                $this->view->render('register/login');
                if ($role === 'pharmacy'){
                    echo('<br><a href="">Apply For a Pharmacy Account</a>');
                }else{
                    echo('<br><label>Need an account? <a href="">Sign up</a></label>');    
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

        public static function getCurrentRole(){
            return self::$_role;
        }
    }
