<?php 

class MediatorHandler extends Controller{

    public function __construct($controller,$action)
    {
        parent::__construct($controller,$action);
        $this->load_model('Mediator');
        $this->load_model('User');
        $this->load_model('Pharmacy');

    }

    public function receiveMessageAction($mode,$id){

        if ($_SESSION['role']==='pharmacy') {
            $this->PharmacyModel = Pharmacy::currentLoggedInPharmacy();
            $from = $this->PharmacyModel->username;
        }else{
            $this->UserModel = User::currentLoggedInUser();
            $from = $this->UserModel->username;
        }
        if ($mode === 'pharmacy') {
            $this->PharmacyModel->findById($id);
            $to = $this->PharmacyModel->username;
        }else{
            $this->UserModel->findById($id);
            $to = $this->UserModel->username;
        }

        $this->MediatorModel = new Mediator();
        $this->MediatorModel->saveMessage($_POST,$to,$from);

        $this->view->render('mediator/sucess');

    }
}