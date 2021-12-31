<?php

class PrefilledformHandler extends Controller{

    public function __construct($controller,$action)
    {
        parent::__construct($controller,$action);
        $this->load_model('User');
        $this->load_model('Pharmacy');
        $this->load_model('Prefilledform');
        $this->load_model('Item',-1);
    }

    public function loadFormAction($PharmId){
        $this->PharmacyModel->findById($PharmId);
        $this->view->pharmName = $this->PharmacyModel->name;
        $this->view->pharmId = $PharmId;
        //dnd($this->view->formId);
        $this->view->render('search/prefilled_form');
    }

    public function searchItemAction($PharmId){
        $results = $this->ItemModel->searchItem($_POST["item-name"], $PharmId);
        $this->view->result = $results;
        $this->getValues($PharmId);
        $this->view->processed = true;
        //dnd($this->view->result);
        if(isset($_SESSION['tempItemId'])){$this->getItemModels(array_keys($_SESSION['tempItemId']));}
        $this->view->render('search/prefilled_form');
    }

    public function addItemAction($itemId, $PharmId){
        if(isset($_SESSION['tempItemId'])){
            if(!in_array($itemId, $_SESSION['tempItemId'])){$_SESSION['tempItemId'][$itemId] = 0;}
        }else{$_SESSION['tempItemId'][$itemId] = 0;}
        //dnd($_SESSION['tempItemId']);
        $this->getValues($PharmId);
        $this->getItemModels(array_keys($_SESSION['tempItemId']));
        $this->view->render('search/prefilled_form');
    }

    public function addQuantityAction($itemId, $PharmId){
        $quantity = $_POST['quantity'];
        $status = $this->checkAvailability($quantity,$itemId);
        $_SESSION['tempItemId'][$itemId] = $quantity. ','.$status;
        $this->getValues($PharmId);
        $this->getItemModels(array_keys($_SESSION['tempItemId']));
        $this->view->render('search/prefilled_form');
    }
    
    public function checkAvailability($quantity,$itemId){
        $this->ItemModel->findById($itemId);
        if($this->ItemModel->quantity >= $quantity){
            return 'Available';
        }else {
            return 'Not Available';
        }    
    }

    private function getValues($PharmId){
        $this->PharmacyModel->findById($PharmId);
        $this->view->pharmName = $this->PharmacyModel->name;
        $this->view->pharmId = $PharmId;
    }

    private function getItemModels($idArr){
        $cond = '';
        foreach($idArr as $id){
            $cond .= 'id=' . $id . ' OR ';
        }
        $cond = rtrim($cond, ' OR ');
        //  dnd($cond);
        $this->view->items = $this->ItemModel->find(['conditions'=>$cond]);
    }

    public function loadSearchFormAction($pharmId,$clear=''){
        if ($clear === 'clear'){
            if (isset($_SESSION['rawData'])){
                unset($_SESSION['rawData']);
            }
        }
        if ($pharmId != -1){
            $this->PharmacyModel->findById($pharmId);
            $this->view->pharmName = $this->PharmacyModel->name;
            $this->view->pharmId = $pharmId;
        }else {
            $this->view->pharmName = 'Nearby Pharmacies';
        }
       
        $this->view->render('search/searchform');
    }

    public function addRawItemAction($pharmId){
        if ($pharmId != -1){
            $this->PharmacyModel->findById($pharmId);
            $this->view->pharmName = $this->PharmacyModel->name;
            $this->view->pharmId = $pharmId;
        }else {
            $this->view->pharmId = -1;
            $this->view->pharmName = 'Nearby Pharmacies';
        }
        $_SESSION['rawData'][$_POST['item-name']] = $_POST['quantity'];
        $this->view->render('search/searchform');
    }

    public function processItemsAction ($pharmId){
        if (isset($_SESSION['tempItemId'])){
            unset($_SESSION['tempItemId']);
        }
        if (!isset($_SESSION['rawData'])) {
            $_SESSION['rawData'] = [];
        }
        $rawData = $_SESSION['rawData'];
        if ($pharmId != -1){
            $this->PharmacyModel->findById($pharmId);
            $this->view->pharmName = $this->PharmacyModel->name;
            $this->view->pharmId = $pharmId;
            foreach ($rawData as $key => $value) {
                $result = $this->ItemModel->searchItem($key, $pharmId);
                if ($result){
                    $result = $result[0];
                    $itemId = $result->id;
                    $quantity = $value;
                    $status = $this->checkAvailability($quantity,$itemId);
                    if(isset($_SESSION['tempItemId'])){
                        if(!in_array($itemId, $_SESSION['tempItemId'])){
                            $_SESSION['tempItemId'][$itemId] = $quantity. ','.$status;
                        }
                    }else{
                        $_SESSION['tempItemId'][$itemId] = $quantity. ','.$status;
                    }
                }               
            }
            if(isset($_SESSION['tempItemId'])){$this->getItemModels(array_keys($_SESSION['tempItemId']));}     
            $this->view->render('search/prefilled_form');
        }else {
            $this->searchFromNearbyPharmacies($rawData);
        }
       
    }

    public function nearByAction($clear=''){
        if ($clear === 'clear'){
            if (isset($_SESSION['rawData'])){
                unset($_SESSION['rawData']);
            }
        }
        $this->view->pharmId = -1;
        $this->view->pharmName = 'Near By Pharmacies';
        $this->view->render('search/searchform');
    }

    private function searchFromNearbyPharmacies($items){
        $user = User::currentLoggedInUser();
        $pharmacyIds = explode(',',$user->nearbypharmacies);
        $cond = '';
        $pharmacies = [];
        foreach($pharmacyIds as $id){
            $cond .= 'id=' . $id . ' OR ';
        }
        $cond = rtrim($cond, ' OR ');
        //dnd($cond);
        $pharmacies = $this->PharmacyModel->find(['conditions'=>$cond]);
        $availabilty = [];
        $pharm_map = [];
        foreach ($pharmacies as $pharmacy) {
            $pharm = new Pharmacy();
            $pharm->findById($pharmacy->id);
            if ($pharm->getavailabity($items)[0] > 0) {
                $availabilty[$pharmacy->id] = $pharm->getavailabity($items);
                $pharm_map [$pharmacy->id] = $pharmacy->name;
            }
        }

        arsort($availabilty);

        $this->view->availabilty = $availabilty;
        $this->view->pharm_map = $pharm_map;
        $this->view->items = $items;
        $this->view->pharmName = 'nearBy';
        $_SESSION['rawData'] = $items;
        $this->view->render('search/nearbypharmforms');
        
    }

    public function clearItemsAction($pharmID,$pharmName){
        unset($_SESSION['rawData']);
        $this->pharmID = $pharmID;
        $this->pharmName = $pharmName;
        $this->view->render('search/searchform');
    }

}