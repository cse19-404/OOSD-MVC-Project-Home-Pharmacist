<?php 

class PharmacyDashboard extends Controller{
    public function __construct($controller,$action)
    {
        parent::__construct($controller,$action);
        $this->load_model("User");
    }

    public function indexAction() {
        if (isset($_SESSION['isPrescription'])){
            unset($_SESSION['isPrescription']);
        }
        $this->view->render('user/dashboard');       
    }

    public function orderForCustomerAction(){
        $results = $this->UserModel->searchCustomer($_POST["customer-name"]);
        $pharmacy = Pharmacy::currentLoggedInPharmacy();
        $this->view->pharmId = $pharmacy->id;
        $this->view->processed = true;
        $this->view->result = $results;
        $this->view->render('search/searchCustomer');
    }

    public function searchCustomerAction(){
        $this->view->render('search/searchCustomer');
    }

    public function loadFormAction($userId){
        $user = new User();
        $user->findById($userId);
        $pharmacy = Pharmacy::currentLoggedInPharmacy();
        $this->view->customerName = $user->name;
        $this->view->pharmName = $pharmacy->name;
        $this->view->pharmId = $pharmacy->id;
        $this->view->preId = -1;
        $this->view->orderfromPharm = true;
        $this->view->render('search/searchForm');
    }
}