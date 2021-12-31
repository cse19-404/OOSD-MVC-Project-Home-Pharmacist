<?php 

class CustomerDashboard extends Controller{
    public function __construct($controller,$action)
    {
        parent::__construct($controller,$action);
        $this->load_model("User");
        $this->load_model('Pharmacy');
    }

    public function indexAction() {
        $this->view->render('user/dashboard');
    }

    public function searchAction(){
        if (isset($_SESSION['rawData'])){
            unset($_SESSION['rawData']);
        }
        $this->view->render('search/select_search');
    }

    public function searchByPharmacyAction($prescription = ''){
        $results = $this->UserModel->searchPharmacy($_POST["pharm-name"]);
        $this->view->result = $results;
        $this->view->processed = true;
        if ($prescription==='prescription'){
            $this->selectSearchAction('prescription');
        }else {
            $this->selectSearchAction('selected');
        }    
    }

    public function selectSearchAction($mode){
        $this->view->searchMode = $mode;
        $this->searchAction();
    }

    public function messageAction(){
        $this->view->render('mediator/contact');
    }

    public function selectContactAction($mode){
        $this->view->mode = $mode;
        $this->view->render('mediator/contact');
    }

    public function searchPharmacyAction(){
        $results = $this->UserModel->searchPharmacy($_POST["pharm-name"]);
        $this->view->result = $results;;
        $this->selectContactAction('pharmacy');
    }

    public function loadMailFormAction($mode,$id){
        if($mode === 'pharmacy'){
            $this->PharmacyModel->findById($id);
            $this->view->to = $this->PharmacyModel->name;
        }else{
            $this->UserModel->findById($id);
            $this->view->to = $this->UserModel->name;
        }
        $this->view->id = $id;
        $this->view->mode = $mode;
        $this->view->render('mediator/mailform');
    }

    public function searchCustomerAction(){
        $results = $this->UserModel->searchCustomer($_POST["name"]);
        $this->view->result = $results;;
        $this->selectContactAction('customer');           
    }

}