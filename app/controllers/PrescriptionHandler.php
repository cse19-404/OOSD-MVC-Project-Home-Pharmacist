<?php 

    class PrescriptionHandler extends Controller
    {
        public function __construct($controller,$action)
        {
            parent::__construct($controller,$action);
            $this->load_model('PrefilledForm');
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

        public function uploadPrescriptionAction($userId,$pharmId){
            if (isset($_POST['submit'])){
                $target_dir = 'uploads/prescriptions/';
                $target_file = $target_dir . basename($_FILES["documents"]["name"]);
                if(move_uploaded_file($_FILES["documents"]["tmp_name"], $target_file)){
                    $this->PrefilledFormModel->insert([
                        'customer_id'=>$userId,
                        'pharmacy_id'=>$pharmId ,
                        'prescription'=>$target_file
                    ]);
                    $this->view->msg = 'Successfully Uploaded the prescription';
                }else {
                    $this->view->msg = 'Prescription Upload Failed';
                }
            }
            $this->assignToView($pharmId);
            $this->view->render('prescriptions/prescriptionUpload');
        }

        private function assignToView($pharmId){
            $pharm = new Pharmacy();
            $pharm->findById($pharmId);
            $this->view->pharmName = $pharm->name;
            $this->view->pharmId = $pharm->id;
            $user = User::currentLoggedInUser();
            $this->view->userId = $user->id;
            $this->view->userName = $user->name;
        }

        public function uploadtonearbyPharmAction(){
            $this->UserModel = User::currentLoggedInUser();
            $pharmacies = explode(',',$this->UserModel->nearbypharmacies);
            foreach ($pharmacies as $id) {
                $pharmacy = new Pharmacy();
                $pharmacy->findById($id);
                $this->view->pharmacies[$id] = $pharmacy;
            }
            $this->view->userId = $this->UserModel->id;
            $this->view->render('prescriptions/nearbyPharmacies');
        }

    }
    