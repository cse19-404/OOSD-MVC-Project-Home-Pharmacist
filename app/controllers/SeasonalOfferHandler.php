<?php

class SeasonalOfferHandler extends Controller{

    public function __construct($controller,$action)
    {
        parent::__construct($controller,$action);
        $this->load_model('User');
        $this->load_model('Pharmacy');
        //$this->load_model('Prefilledform');
        //$this->load_model('Item',-1);
        $this->load_model('Offer');
        $this->load_model('Mediator');

    }
    public function viewAction(){
        if (isset($_SESSION['tempItemId'])){
            unset($_SESSION['tempItemId']);
        }
        if (isset($_SESSION['rawData'])){
            unset($_SESSION['rawData']);
        }
        $_SESSION['isSeasonal']=true;
        if($_SESSION['role']=="pharmacy"){
            $this->PharmacyModel=Pharmacy::currentLoggedInPharmacy();
            $result = $this->PharmacyModel->findOffers("all");
            if($result){
                $this->view->results = $result;
            }else{
                $this->view->results = [];
            }
            
            //dnd($this->PharmacyModel);
            // $resultQuery=$this->PharmacyModel->findAlloffers();
            // $this->view->result=$resultQuery;
            $this->view->render('user/view_offers_section');
        }elseif($_SESSION['role']=="customer"){
            $this->UserModel=User::currentLoggedInUser();
            $allOffers=$this->UserModel->findAllOffers();
            $result=[];
            $pharmacies=[];
            if(isset($allOffers)){
                foreach($allOffers as $row){
                    if(array_key_exists($row->pharmacy_id,$result)){
                        $result[$row->pharmacy_id][]=$row;
                    } else{
                        $result[$row->pharmacy_id]=[$row];
                        $newPharmacy = new Pharmacy();
                        $newPharmacy->findById($row->pharmacy_id);
                        $pharmacies[$row->pharmacy_id] = [$newPharmacy];
                    }              
                }
            }
            $this->view->results = $result;
            $this->view->pharmacies=$pharmacies;
            //dnd($pharmacies[1][0]->address);
            //dnd($result);
            $this->view->render('user/view_offers_section');       
        }
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
            
        }elseif($mode==='renew'){
            $this->load_model('Offer');
            $this->OfferModel->findFirst(['conditions'=>'id=?','bind' => [$OfferId]]);
            //dnd($this->ItemModel);
            $this->view->OfferData = (array)$this->OfferModel->data();
            //dnd($this->view->OfferData);
            $this->view->mode = $mode;
            $this->view->PharmId = Pharmacy::currentLoggedInPharmacy()->id;
            $this->view->OfferId=$OfferId;
            $this->view->render('user/view_offer');
        }
        else{
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
        $target_dir = 'uploads/';
        $target_file = $target_dir . basename($_FILES["bannerdocument"]["name"]);
        if($target_file !== 'uploads/'){
            $validation->imageCheck(strtolower(pathinfo($target_file,PATHINFO_EXTENSION)));
        }
        $validation->dateCheck($_POST["start_date"],$_POST["end_date"]);
        
        if($validation->passed()){
            //dnd($_FILES);
            $postCopy = $_POST;
            unset($postCopy['submit']);
            $postCopy['status']=0;
            //dnd($_FILES["bannerdocument"]["tmp_name"]!="");
            if($_FILES["bannerdocument"]["tmp_name"]!=""){
                
                //dnd($target_file);
                $postCopy['bannerdocument'] = $target_file;
                
                if(move_uploaded_file($_FILES["bannerdocument"]["tmp_name"], $target_file)){
                    if($mode==='edit'){
                        $this->OfferModel->update($OfferId,$postCopy);
                        $this->NotifyCustomers($mode,$OfferId,'Image Changed');
                    }
                    elseif($mode==='renew'){
                        //$postCopy['pharmacy_id']=Pharmacy::currentLoggedInPharmacy()->id;
                        $postCopy['isexpired']=0;
                        $this->OfferModel->update($OfferId,$postCopy);
                        //$this->NotifyCustomers($mode,$OfferId,'Image Changed');
                    }
                    else{
                        $postCopy['pharmacy_id']=Pharmacy::currentLoggedInPharmacy()->id;
                        $this->OfferModel->insert($postCopy);
                        $OfferId = $this->OfferModel->getLastId();
                        $this->NotifyCustomers('new',$OfferId,'new');
                    }        
                }else {
                    echo ("Sorry, there was an error uploading your file.");
                }
            }else{
                //dnd($postCopy);
                if($mode==='edit'){
                    $this->OfferModel->update($OfferId,$postCopy);
                    $this->NotifyCustomers($mode,$OfferId,'Details Changed');
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

    private function NotifyCustomers($mode,$OfferId,$msg){
        $this->PharmacyModel = Pharmacy::currentLoggedInPharmacy();
        $from = $this->PharmacyModel->username;
        $this->MediatorModel->receiveSeasonalOffers($mode,$OfferId,$from,$msg);
    }
 
}
?>