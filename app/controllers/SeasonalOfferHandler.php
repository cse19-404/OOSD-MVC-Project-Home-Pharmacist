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
        $result = $this->PharmacyModel->findAllOffers();
        $this->view->results = $result;
        //dnd($this->PharmacyModel);
        // $resultQuery=$this->PharmacyModel->findAlloffers();
        // $this->view->result=$resultQuery;
        $this->view->render('user/view_offers_section');
    }


    public function viewOfferAction($mode,$OfferId=''){
          
        if($mode==='edit'){
            $this->load_model('Offer');
            $this->OfferModel->findFirst(['conditions'=>'id=?','bind' => [$OfferId]]);
            //dnd($this->ItemModel);
            $this->view->OfferData = (array)$this->OfferModel->data();
            //dnd($this->view->OfferData);
            $this->view->mode = $mode;
            $this->view->PharmId = Pharmacy::currentLoggedInPharmacy()->id;
            $this->view->OfferId=$OfferId;
            $this->view->render('user/view_offer');
            
        }else{
            $this->view->OfferData = (array)$this->OfferModel->data();
            //dnd($this->view->OfferData);
            $this->view->mode = $mode;
            $this->view->PharmId = Pharmacy::currentLoggedInPharmacy()->id;
            //dnd($this->view->PharmId);
            $this->view->OfferId=$OfferId;
            $this->view->render('user/view_offer');
        }
    }

    public function saveOfferAction($mode,$PharmId,$OfferId=''){
        //dnd($_POST);
        $this->view->OfferId=$OfferId;
        $this->view->PharmId=$PharmId;
        if($mode==='add'){
            $this->view->OfferData = (array)$_POST;   
        } else{
            $this->OfferModel->findFirst(['conditions'=>'id=?','bind' => [$OfferId]]);
            $this->view->OfferData = (array)$this->OfferModel->data();
        }
        $validation = new Validate();
        $validation->check($_POST,[
            "name" => [
                "display"=>"name",
                "required" => true
            ],
            "description" => [
                "display" => "Offer Description",
                "required" => true
            ],
            "start_date" => [
                "display" => "Starting Date",
                "required" => true
            ],
            "end_date" => [
                "display" => "Ending Date",
                "required" => true
            ],
        ]);
        $validation->dateCheck($_POST["start_date"],$_POST["end_date"]);
        if($validation->passed()){
            //dnd($_FILES);
            $postCopy = $_POST;
            unset($postCopy['submit']);
            $postCopy['status']=0;
            //dnd($_FILES["bannerdocument"]["tmp_name"]!="");
            if($_FILES["bannerdocument"]["tmp_name"]!=""){
                $target_dir = 'uploads/';
                $target_file = $target_dir . basename($_FILES["bannerdocument"]["name"]);
                //dnd($target_file);
                $postCopy['bannerdocument'] = $target_file;
                
                if(move_uploaded_file($_FILES["bannerdocument"]["tmp_name"], $target_file)){
                    if($mode==='edit'){
                        $this->OfferModel->update($OfferId,$postCopy);
                    } else{
                        $postCopy['pharmacy_id']=Pharmacy::currentLoggedInPharmacy()->id;
                        $this->OfferModel->insert($postCopy);
                    }        
                }else {
                    echo ("Sorry, there was an error uploading your file.");
                }
            }else{
                //dnd($postCopy);
                if($mode==='edit'){
                    $this->OfferModel->update($OfferId,$postCopy);
                } 
            }  
            Router::redirect('SeasonalOfferHandler/view');
        } else{
            $this->view->displayErrors = $validation->displayErrors();
            $this->view->mode = $mode;
            $this->view->PharmId = Pharmacy::currentLoggedInPharmacy()->id;
            $this->view->OfferId=$OfferId;
            $this->view->render('user/view_offer');
        }
    }

    public function deleteOfferAction($id){
        $this->OfferModel->deleteOffer($id);
        //$this->view->render('user/view_offers_section');
        Router::redirect('SeasonalOfferHandler/view');
    }


    private function getValues($PharmId){
        $this->PharmacyModel->findById($PharmId);
        $this->view->pharmName = $this->PharmacyModel->name;
        $this->view->PharmId = $PharmId;
    }
 
}
?>