<?php

class SeasonalOfferHandler extends Controller{

    public function __construct($controller,$action)
    {
        parent::__construct($controller,$action);
        $this->load_model('User');
        $this->load_model('Pharmacy');
        $this->load_model('Prefilledform');
        $this->load_model('Item',-1);
        $this->load_model('Offer');

    }
    public function viewAction(){
        $this->PharmacyModel=Pharmacy::currentLoggedInPharmacy();
        //dnd($this->PharmacyModel);
        // $resultQuery=$this->PharmacyModel->findAlloffers();
        // $this->view->result=$resultQuery;
        $this->view->render('user/view_offers_section');
    }


    public function viewOfferAction($mode,$id=-1){
          
        if($mode==='edit'){
            $this->load_model('Item',$id);
            $this->ItemModel->findFirst(['conditions'=>'id=?','bind' => [$id]]);
            //dnd($this->ItemModel);
            $this->view->itemData = (array)$this->ItemModel->data();
            //dnd($this->view->itemData);
            $this->view->mode = $mode;
            $this->view->render('user/view_item');
            
        }else{
            $this->view->OfferData = (array)$this->OfferModel->data();
            //dnd($this->view->OfferData);
            $this->view->mode = $mode;
            $this->view->render('user/view_offer');
        }
    }

    public function saveOfferAction($mode,$id=''){
        //dnd($_POST);
        if($mode==='add'){
            $this->view->OfferData = (array)$_POST;   
        } else{
            $this->OfferModel->findFirst(['conditions'=>'id=?','bind' => [$id]]);
            $this->view->OfferData = (array)$this->OfferModel->data();
        }
        // $validation = new Validate();
        // $validation->check($_POST,[
        //     "quantity" => [
        //         "display"=>"Quantity",
        //         "is_numeric" => true
        //     ],
        //     "price_per_unit_quantity" => [
        //         "display" => "Price per Unit Quantity",
        //         "is_numeric" => true
        //     ]                
        // ]);
        //if($validation->passed()){
        $postCopy = $_POST;
        
        unset($postCopy['submit']);
        if($mode==='edit'){
            $this->OfferModel->update($id,$postCopy);
        } else{
            $postCopy['pharmacy_id']=Pharmacy::currentLoggedInPharmacy()->id;
            $this->OfferModel->insert($postCopy);
        }  
        Router::redirect('SeasonalOfferHandler/view');
        // } else{
        //     $this->view->displayErrors = $validation->displayErrors();
        //     $this->view->render('user/view_item');
        // }
    }

    public function addFormAction($mode){
        $this->PharmacyModel=Pharmacy::currentLoggedInPharmacy(); 
        if($mode==='add'){
            $this->view->pharmId = $this->PharmacyModel->id;
            $this->view->pharmName = $this->PharmacyModel->name;
            //dnd($this->PharmacyModel);
            $this->view->render('search/prefilled_form');
        }
    }

}
?>