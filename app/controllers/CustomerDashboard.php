<?php 

class CustomerDashboard extends Controller{
    public function __construct($controller,$action)
    {
        parent::__construct($controller,$action);
        $this->load_model("User");
        $this->load_model('Pharmacy');
        $this->load_model('Mediator');
        $this->load_model('Order');
    }

    public function indexAction() {
        unsetSession("all");
        // if (isset($_SESSION['isSeasonal'])){
        //     unset($_SESSION['isSeasonal']);
        // }
        $this->view->render('user/dashboard');
    }

    public function searchAction(){
        if (isset($_SESSION['isNearBy'])){
            unset($_SESSION['isNearBy']);
        }
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
        if ($mode === 'us') {
            $this->loadMailFormAction($mode,1);
        }else {
            $this->view->render('mediator/contact');
        }
        
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
        $this->view->result = $results;
        $this->selectContactAction('customer');           
    }

    public function replyTextMessageAction($id){
        $this->MediatorModel = new Mediator();
        $result = $this->MediatorModel->getMessage($id)[0];
        $this->view->to = $result->sender_username; 
        $this->view->from = $result->receiver_username;
        $this->view->subject = $result->subject; 
        $this->view->id = $result->id;
        $this->view->mode = 'reply';    
        $this->view->render('mediator/mailform');
    }

    public function viewPurchaseHistoryAction(){
        $status ="";
        $this->view->filter = 'All';
        if (isset($_POST['filter-status'])){
            $status = $_POST['filter-status'];
            $this->view->filter = $status;
        }
        $status = ($status === 'All') ? '':$status;
        $results = $this->OrderModel->getCustomerOrdersByFilter($status);
        $this->view->results = $results;
        $this->view->results =[];
        foreach($results as $result){
            $user = new Pharmacy();
            $user->findById($result->pharmacy_id);
            $this->view->results [$result->id] = [$user,$result];
        }
        $this->view->render('order/viewOrders');
    }

}