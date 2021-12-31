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

    public function inboxAction(){
        if ($_SESSION['role']==='pharmacy') {
            $this->PharmacyModel = Pharmacy::currentLoggedInPharmacy();
            $receiver = $this->PharmacyModel->username;
        }else{
            $this->UserModel = User::currentLoggedInUser();
            $receiver = $this->UserModel->username;
        }
        $result = $this->MediatorModel->findAllMessages($receiver);
        $this->view->result = $result;
        $this->view->render('mediator/inbox');
    }

    public function loadInboxAction($id){
        $this->MediatorModel = new Mediator();
        $this->MediatorModel->markAsRead($id);
        $result = $this->MediatorModel->getMessage($id)[0];
        $this->view->mode = 'read-only';
        $this->view->result = $result;
        $this->view->render('mediator/mailform');
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

    public function receiveReplyAction($id){
        $this->MediatorModel = new Mediator();
        $result = $this->MediatorModel->getMessage($id)[0];  
        $to = $result->sender_username; 
        $from = $result->receiver_username;              
        $this->MediatorModel = new Mediator();
        $this->MediatorModel->saveMessage($_POST,$to,$from);

        $this->view->render('mediator/sucess');
    }
}