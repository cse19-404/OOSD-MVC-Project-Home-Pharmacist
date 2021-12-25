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

        public function changeStatusAction(){
            $this->ApplicationModel->changeStatus($_POST['id'],$_POST['status']);
            Router::redirect('ApplicationHandler/view');
        }

        public function deleteApplicationAction(){
            $this->ApplicationModel->deleteApplication($_POST['id']);
            Router::redirect('ApplicationHandler/view');
        }

    }