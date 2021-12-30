<?php 

class CustomerDashboard extends Controller{
    public function __construct($controller,$action)
    {
        parent::__construct($controller,$action);
        $this->load_model("User");
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

    public function searchByPharmacyAction(){
        $results = $this->UserModel->searchPharmacy($_POST["pharm-name"]);
        $this->view->result = $results;
        $this->view->processed = true;
        $this->selectSearchAction('selected');
    }

    public function selectSearchAction($mode){
        $this->view->searchMode = $mode;
        $this->searchAction();
    }
}