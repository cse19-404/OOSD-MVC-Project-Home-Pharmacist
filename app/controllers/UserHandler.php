<?php 

    class UserHandler extends Controller{

        public function __construct($controller,$action)
        {
            parent::__construct($controller,$action);
            $this->load_model('User');
        }


        public function viewAction(){
            $this->UserModel = User::currentLoggedInUser();
            $result_customers = $this->UserModel->findAllUsers();
            $result_pharmacies = $this->UserModel->findAllPharmacies();
            $this->view->result_customer = $result_customers;
            $this->view->result_pharmacies = $result_pharmacies;
            $this->view->render('user/view_users');
        }

    }