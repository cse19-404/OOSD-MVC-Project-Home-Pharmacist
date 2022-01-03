<?php 

    class UserHandler extends Controller{

        public function __construct($controller,$action)
        {
            parent::__construct($controller,$action);
            $this->load_model('User');
            $this->load_model('Application');
            $this->load_model('Pharmacy');
        }

        public function viewAction(){
            $this->UserModel = User::currentLoggedInUser();
            $result_customers = $this->UserModel->findAllUsers();
            $result_pharmacies = $this->UserModel->findAllPharmacies();
            $this->view->result_customer = $result_customers;
            $this->view->result_pharmacies = $result_pharmacies;
            $this->view->render('user/view_users');
        }

        public function pharmAccCreatAction($id){
            $this->ApplicationModel->findFirst(['conditions'=>'id=?', 'bind'=>[$id]]);
            $validation = new Validate();
            if($_POST){
                $validation->check($_POST,[
                    'password'=>[
                        'display'=>'Password',
                        'min'=>6
                    ],
                    'username'=>[
                        'display'=>'Username',
                        'min'=>4
                    ],
                    'repassword'=>[
                        'display'=>'Confirm Password',
                        'matches'=>'password'
                    ],
                    'username'=>[
                        'display'=>'Username',
                        'unique'=>'pharmacytable'
                    ]
                ]);
                if ($validation->passed()){
                    $this->PharmacyModel = new Pharmacy();
                    $this->PharmacyModel->registerNewPharmacy($_POST, $id);
                    $this->ApplicationModel->findById($id);
                    $msg = "Your Account has created. username =".$this->ApplicationModel->email.", password = password";
                    sendmail($msg,$this->ApplicationModel->email,"Application Creation");
                    $this->updatenearbypharmacies();

                    Router::redirect('ApplicationHandler/viewApproved');
                }else {
                    $this->view->displayErrors = $validation->displayErrors();
                    $this->view->application = $this->ApplicationModel;
                    $this->view->render('user/pharm_account_creation');
                }
            }else{
                $this->view->application = $this->ApplicationModel;
                $this->view->render('user/pharm_account_creation');
            }

        }

        public function updatenearbypharmacies(){
            $users = $this->UserModel->find();
            
            foreach ($users as $user) {
                $nearbypharmacies = $user->getAllNearByPharmacies($user->latitude,$user->longitude);
                $user->nearbypharmacies = $nearbypharmacies;
                $user->save();
            }
            
        }

        public function removeCustomerAccountAction(){
            $this->UserModel->removeCustomerAccount($_POST['id']);
            Router::redirect('UserHandler/view');
        }

        public function removePharmacyAccountAction(){
            $this->PharmacyModel->removePharmacyAccount($_POST['id']);
            Router::redirect('UserHandler/view');
        }

    }