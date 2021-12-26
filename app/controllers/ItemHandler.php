<?php 

    class ItemHandler extends Controller{

        public function __construct($controller,$action)
        {
            parent::__construct($controller,$action);
            $this->load_model('Pharmacy');
            $this->load_model('Item');
        }

        public function viewAction(){
            $this->PharmacyModel = Pharmacy::currentLoggedInPharmacy();
            $result = $this->PharmacyModel->findAllItems();
            $this->view->items = $result;
            $this->view->render('user/view_inventory');
        }

        public function viewItemAction($mode,$id=''){
            if($mode==='edit'){
                $this->ItemModel->findFirst(['conditions'=>'id=?','bind' => [$id]]);
                //dnd($this->ItemModel);
                $this->view->itemData = (array)$this->ItemModel->data();
                //dnd($this->view->itemData);
                $this->view->mode = $mode;
                $this->view->render('user/view_item');
            }else{
                $this->view->itemData = (array)$this->ItemModel->data();
                $this->view->mode = $mode;
                $this->view->render('user/view_item');
            }
        }

        public function editItemAction($id){
            $validateObj = new Validate();
            $postCopy = $_POST;
            if(isset($postCopy['prescription_needed']) && $postCopy['prescription_needed']=='on'){
                $postCopy['prescription_needed'] = 1;
            }else{
                $postCopy['prescription_needed'] = 0;
            }
            unset($postCopy['submit']);
            $this->ItemModel->update($id,$postCopy);
            Router::redirect('ItemHandler/view');
        }

        public function addItemAction(){
            $validateObj = new Validate();
            $postCopy = $_POST;
            if(isset($postCopy['prescription_needed']) && $postCopy['prescription_needed']=='on'){
                $postCopy['prescription_needed'] = 1;
            }else{
                $postCopy['prescription_needed'] = 0;
            }
            unset($postCopy['submit']);
            $postCopy['pharmacy_id']=Pharmacy::currentLoggedInPharmacy()->id;
            //dnd($postCopy);
            $this->ItemModel->insert($postCopy);
            Router::redirect('ItemHandler/view');
        }

        public function deleteItemAction($id){
            $this->ItemModel->update($id,['status'=> 1]);
            Router::redirect('ItemHandler/view');
        }


            
        

        // public function viewApprovedAction(){
        //     $this->UserModel = User::currentLoggedInUser();
        //     $result = $this->UserModel->findApprovedApplications();
        //     $this->view->approvedApplications = $result;
        //     $this->view->render('user/view_approved_applications');
        // }

        // public function changeStatusAction(){
        //     $this->ApplicationModel->changeStatus($_POST['id'],$_POST['status']);
        //     Router::redirect('ApplicationHandler/view');
        // }

        // public function deleteApplicationAction(){
        //     $this->ApplicationModel->deleteApplication($_POST['id']);
        //     Router::redirect('ApplicationHandler/view');
        // }
        // ["id"]=>
        // string(1) "1"
        // ["name"]=>
        // string(6) "KLODIC"
        // ["code"]=>
        // string(6) "R3475M"
        // ["quantity_unit"]=>
        // string(7) "TABLETS"
        // ["quantity"]=>
        // string(4) "1350"
        // ["price_per_unit_quantity"]=>
        // string(2) "10"
        // ["prescription_needed"]=>
        // string(1) "1"
        // ["pharmacy_id"]=>
        // string(1) "1"
        // ["status"]=>
        // string(1) "0"

    }