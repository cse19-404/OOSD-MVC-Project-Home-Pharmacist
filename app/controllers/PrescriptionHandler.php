<?php 

    class PrescriptionHandler extends Controller
    {
        public function __construct($controller,$action)
        {
            parent::__construct($controller,$action);
        }

        public function selectMethodAction(){
            $user = User::currentLoggedInUser();
            $this->view->render('prescriptions/selectMethod');
        }

        public function loadPrescriptionAction($pharmId){
            $pharm = new Pharmacy();
            $pharm->findById($pharmId);
            $this->view->pharmName = $pharm->name;
            $this->view->pharmId = $pharm->id;
            $user = User::currentLoggedInUser();
            $this->view->userId = $user->id;
            $this->view->userName = $user->name;
            $this->view->render('prescriptions/prescriptionUpload');
        }

    }
    