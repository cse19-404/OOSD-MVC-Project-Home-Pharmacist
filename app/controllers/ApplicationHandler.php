<?php 

    class ApplicationHandler extends Controller{

        public function __construct($controller,$action)
        {
            parent::__construct($controller,$action);
            $this->load_model('User');
            $this->load_model('Application');
        }

        public function viewAction(){
            $this->UserModel = User::currentLoggedInUser();
            $result = $this->UserModel->findAllApplications();
            $this->view->applications = $result;
            $this->view->render('user/view_applications');
        }

        public function viewApprovedAction(){
            $this->UserModel = User::currentLoggedInUser();
            $result = $this->UserModel->findApprovedApplications();
            $this->view->approvedApplications = $result;
            $this->view->render('user/view_approved_applications');
        }

        public function changeStatusAction(){
            $this->ApplicationModel->findById($_POST['id']);
            $email = $this->ApplicationModel->email;
            $status = $_POST['status'];
            $id = $_POST['id'];
            $this->ApplicationModel->changeStatus($_POST['id'],$_POST['status']);
            if ($status === 'approved'){
                sendmail("Your Application has approved",$email,"Application Approved");
                Router::redirect('ApplicationHandler/view');
            }else if ($status === 'declined'){
                $this->view->id = $id;
                $this->view->render('mail/mailForm');
            }else {
                Router::redirect('ApplicationHandler/view');
            }         
        }

        public function deleteApplicationAction(){
            $this->ApplicationModel->deleteApplication($_POST['id']);
            Router::redirect('ApplicationHandler/view');
        }

        public function declineAction($id){
            $this->ApplicationModel->findById($id);
            $email = $this->ApplicationModel->email;
            sendmail($_POST['msg'],$email,$_POST['subject']);
            Router::redirect('ApplicationHandler/view');
        }

    }