<?php 

    class ItemHandler extends Controller{


        public function __construct($controller,$action)
        {
            parent::__construct($controller,$action);
            $this->load_model('Pharmacy');
            //var_dump($GLOBALS);
            $this->load_model('Item',-1);
        }

        public function viewAction(){
            $this->PharmacyModel = Pharmacy::currentLoggedInPharmacy();
            $result = $this->PharmacyModel->findAllItems();
            $this->view->items = $result;
            $this->view->render('user/view_inventory');
        }

        public function viewItemAction($mode,$id=-1){
            
            if($mode==='edit'){
                $this->load_model('Item',$id);
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
            if($mode==='add'){
                $this->view->itemData = (array)$_POST;
                if(isset($this->view->itemData['prescription_needed'])){
                    $this->view->itemData['prescription_needed']=1;
                } else{
                    $this->view->itemData['prescription_needed']=0;
                }                
                
            } else{
                $this->ItemModel->findFirst(['conditions'=>'id=?','bind' => [$id]]);
                $this->view->itemData = (array)$this->ItemModel->data();
            }
            
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
                // "name"=>[
                //     "display" => "name",
                //     "required" => true
                // ]                
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
                $this->view->mode=$mode;
                $this->view->render('user/view_item');
            }
        }

        public function deleteItemAction($id){
            $this->ItemModel->deleteItem($id);
            //$this->view->render('user/view_inventory');
            Router::redirect('ItemHandler/view');
        }

    }