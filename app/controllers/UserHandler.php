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
                    $this->PharmacyModel->findById($this->PharmacyModel->getLastId());
                    $msg = "Your Account has created. username =".$this->PharmacyModel->username.", password = password".
                    "\nYou can change your username and password by logging in to the account.\nhttp://localhost/home_pharmasist/home/index";
                    sendmail($msg,$this->ApplicationModel->email,"Account Creation");
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
            $this->updatenearbypharmacies();
            Router::redirect('UserHandler/view');
        }

        public function changeDetailsAction($role){
            if ($_POST){
                if ($role === 'customer'){
                    $validate = new Validate();
                    $user = User::currentLoggedInUser();
                    $username = ($_POST['username'] !=="" ) ? $_POST['username'] : "";
                    $password = ($_POST['password'] !=="" ) ? $_POST['password'] : "";
                    $creditionals = [];
                    if ($username !==""){
                        $validate->check(['username'=>$username],[
                            'username'=>[
                                'display'=>'Username',
                                'min'=>4
                            ],
                            'username'=>[
                                'display'=>'Username',
                                'unique'=>'usertable'
                            ]
                        ]);
                        $creditionals['username'] = $username;
                    }
                    if ($password !== ""){
                        $validate->check(['password'=>$password],[
                            'password'=>[
                                'display'=>'Password',
                                'min'=>6
                            ]
                        ]);
                        $creditionals['password'] = password_hash($password, PASSWORD_DEFAULT);
                    }

                    if ($validate->passed()){
                        $user->update($user->id,$creditionals);
                        if (array_key_exists("username",$creditionals)){
                            $_SESSION['username'] = $username;
                        }    
                        Router::redirect('CustomerDashboard');
                    }else {
                        $this->view->displayErrors = $validate->displayErrors();
                        $this->view->role = $role;
                        $this->view->render('user/changeDetails');
                    }

                }else {
                    $validate = new Validate();
                    $pharmacy = Pharmacy::currentLoggedInPharmacy();
                    $username = ($_POST['username'] !=="" ) ? $_POST['username'] : "";
                    $password = ($_POST['password'] !=="" ) ? $_POST['password'] : "";
                    $creditionals = [];
                    if ($username !==""){
                        $validate->check(['username'=>$username],[
                            'username'=>[
                                'display'=>'Username',
                                'min'=>4
                            ],
                            'username'=>[
                                'display'=>'Username',
                                'unique'=>'usertable'
                            ]
                        ]);
                        $creditionals['username'] = $username;
                    }
                    if ($password !== ""){
                        $validate->check(['password'=>$password],[
                            'password'=>[
                                'display'=>'Password',
                                'min'=>6
                            ]
                        ]);
                        $creditionals['password'] = password_hash($password, PASSWORD_DEFAULT);
                    }
                    if (!empty($creditionals) && $validate->passed()){
                        $pharmacy->update($pharmacy->id,$creditionals);    
                        if (array_key_exists("username",$creditionals)){
                            $_SESSION['username'] = $username;
                        }
                        Router::redirect('PharmacyDashboard');
                    }else {
                        $this->view->displayErrors = $validate->displayErrors();
                        $this->view->role = $role;
                        $this->view->render('user/changeDetails');
                    }

                }
            }else {
                $this->view->role = $role;
                $this->view->render('user/changeDetails');
            }
            
        }

    }