<?php 

class PharmacyDashboard extends Controller{
    public function __construct($controller,$action)
    {
        parent::__construct($controller,$action);
    }

    public function indexAction() {
        if (isset($_SESSION['isPrescription'])){
            unset($_SESSION['isPrescription']);
        }
        $this->view->render('user/dashboard');       
    }
}