<?php 

    class Register extends Controller{

        public function __construct($controller,$action)
        {
            parent::__construct($controller,$action);
        }

        public function loginAction($role){
            // if ($_POST){
            //     //do login
            // }else{
            //     $this->view->render('register/login');    
            // }
            $this->view->render('register/login');
            if ($role === 'pharmacy'){
                echo('<br><a href="">Apply For a Pharmacy Account</a>');
            }else{
                echo('<br><label>Need an account? <a href="">Sign up</a></label>');    
            }

        }
    }
