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


        public function saveAction($mode,$id=''){
            //dnd($_POST);
            $this->ItemModel->findFirst(['conditions'=>'id=?','bind' => [$id]]);
            $this->view->itemData = (array)$this->ItemModel->data();
            $validation = new Validate();
            $validation->check($_POST,[
                "quantity" => [
                    "display"=>"Quantity",
                    "is_numeric" => true
                ],
                "price_per_unit_quantity" => [
                    "display" => "Price per Unit Quantity",
                    "is_numeric" => true
                ]                
            ]);
            if($validation->passed()){
                $postCopy = $_POST;
                if(isset($postCopy['prescription_needed']) && $postCopy['prescription_needed']=='on'){
                    $postCopy['prescription_needed'] = 1;
                }else{
                    $postCopy['prescription_needed'] = 0;
                }
                unset($postCopy['submit']);
                if($mode==='edit'){
                    $this->ItemModel->update($id,$postCopy);
                } else{
                    $postCopy['pharmacy_id']=Pharmacy::currentLoggedInPharmacy()->id;
                    $this->ItemModel->insert($postCopy);
                }  
                Router::redirect('ItemHandler/view');
            } else{
                $this->view->displayErrors = $validation->displayErrors();
                $this->view->render('user/view_item');
            }
        }

        public function deleteItemAction($id){
            $this->ItemModel->update($id,['status'=> 1]);
            $this->view->render('user/view_inventory');
            Router::redirect('ItemHandler/view');
        }

        // public function editItemAction($id){
        //     $this->ItemModel->findFirst(['conditions'=>'id=?','bind' => [$id]]);
        //     $this->view->itemData = (array)$this->ItemModel->data();
        //     $validateObj = new Validate();
        //     $postCopy = $_POST;
        //     if(isset($postCopy['prescription_needed']) && $postCopy['prescription_needed']=='on'){
        //         $postCopy['prescription_needed'] = 1;
        //     }else{
        //         $postCopy['prescription_needed'] = 0;
        //     }
        //     unset($postCopy['submit']);
        //     //dnd($postCopy);
        //     $this->ItemModel->update($id,$postCopy);
        //     Router::redirect('ItemHandler/view');
        // }

        // public function addItemAction(){
        //     $this->ItemModel->findFirst(['conditions'=>'id=?','bind' => [$id]]);
        //     $this->view->itemData = (array)$this->ItemModel->data();
        //     $validateObj = new Validate();
        //     $postCopy = $_POST;
        //     if(isset($postCopy['prescription_needed']) && $postCopy['prescription_needed']=='on'){
        //         $postCopy['prescription_needed'] = 1;
        //     }else{
        //         $postCopy['prescription_needed'] = 0;
        //     }
        //     unset($postCopy['submit']);
        //     $postCopy['pharmacy_id']=Pharmacy::currentLoggedInPharmacy()->id;
        //     //dnd($postCopy);
        //     $this->ItemModel->insert($postCopy);
        //     Router::redirect('ItemHandler/view');
        // }
    }