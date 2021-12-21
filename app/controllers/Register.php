<?php 

    class Register extends Controller{

        public function __construct($controller,$action)
        {
            parent::__construct($controller,$action);
        }

        public function loginAction($role){
            if ($_POST){
                //do login
            }else{
                $this->view->render('register/login');    
            }

        }
    }
