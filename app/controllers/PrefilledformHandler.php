<?php

class PrefilledformHandler extends Controller{

    public function __construct($controller,$action)
    {
        parent::__construct($controller,$action);
        $this->load_model('User');
        $this->load_model('Pharmacy');
        $this->load_model('Prefilledform');
        $this->load_model('Item',-1);
        $this->load_model('Mediator');
    }

    public function loadFormAction($PharmId){
        $this->PharmacyModel->findById($PharmId);
        $this->view->pharmName = $this->PharmacyModel->name;
        $this->view->pharmId = $PharmId;
        //dnd($this->view->formId);
        $this->view->render('search/prefilled_form');
    }

    public function searchItemAction($PharmId, $preId=-1){
        $results = $this->ItemModel->searchItem($_POST["item-name"], $PharmId);
        $this->view->result = $results;
        $this->getValues($PharmId);
        $this->view->processed = true;
        $this->setPres($preId);
        //dnd($this->view->result);
        if(isset($_SESSION['tempItemId'])){$this->getItemModels(array_keys($_SESSION['tempItemId']));}
        $this->view->render('search/prefilled_form');
    }

    public function addItemAction($itemId, $PharmId, $preId=-1){
        if(isset($_SESSION['tempItemId'])){
            if(!in_array($itemId, $_SESSION['tempItemId'])){$_SESSION['tempItemId'][$itemId] = 0;}
        }else{$_SESSION['tempItemId'][$itemId] = 0;}
        //dnd($_SESSION['tempItemId']);
        $this->getValues($PharmId);
        $this->getItemModels(array_keys($_SESSION['tempItemId']));

        $this->setPres($preId);

        $this->view->render('search/prefilled_form');
    }

    public function addQuantityAction($itemId, $PharmId, $preId=-1){
        $quantity = $_POST['quantity'];
        $status = $this->checkAvailability($quantity,$itemId);
        $_SESSION['tempItemId'][$itemId] = $quantity. ','.$status;
        $this->getValues($PharmId);
        $this->getItemModels(array_keys($_SESSION['tempItemId']));
        $this->setPres($preId);
        $this->view->render('search/prefilled_form');
    }
    
    public function checkAvailability($quantity,$itemId){
        $this->ItemModel->findById($itemId);
        if($itemId != -1){
            if($this->ItemModel->quantity >= $quantity){
                if ($this->ItemModel->prescription_needed) {
                    return 'Prescription Needed';
                }
                return 'In Stock';
            }else{
                return 'Out of Stock';
            }
        }else{
            return 'No Such Item';
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
            if(is_numeric($id)){$cond .= 'id=' . $id . ' OR ';}
        }
        $cond = rtrim($cond, ' OR ');
        //  dnd($cond);
        $this->view->items = $this->ItemModel->find(['conditions'=>$cond]);
    }

    public function loadSearchFormAction($pharmId, $clear='',$preId='-1'){
        if (isset($_SESSION['removed'])){
            unset($_SESSION['removed']);
        }
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
        $this->setPres($preId);
       
        $this->view->render('search/searchform');
    }

    public function addRawItemAction($pharmId, $preId='-1'){
        if ($pharmId != -1){
            $this->PharmacyModel->findById($pharmId);
            $this->view->pharmName = $this->PharmacyModel->name;
            $this->view->pharmId = $pharmId;
        }else {
            $this->view->pharmId = -1;
            $this->view->pharmName = 'Nearby Pharmacies';
        }
        $_SESSION['rawData'][$_POST['item-name']] = $_POST['quantity'];

        $this->setPres($preId);

        $this->view->render('search/searchform');
    }

    public function processItemsAction ($pharmId, $rmItemId = -1, $preId=-1){
        if (isset($_SESSION['tempItemId'])){
            unset($_SESSION['tempItemId']);
        }
        if (!isset($_SESSION['rawData'])) {
            $_SESSION['rawData'] = [];
        }
        $rawData = $_SESSION['rawData'];
        if (!isset($_SESSION['removed'])){
            $_SESSION['removed'] = [];
        }
        if($rmItemId != -1){array_push($_SESSION['removed'], $rmItemId);}
        
        $this->setPres($preId);

        if ($pharmId != -1){
            $this->PharmacyModel->findById($pharmId);
            $this->view->pharmName = $this->PharmacyModel->name;
            $this->view->pharmId = $pharmId;
            foreach ($rawData as $key => $value) {
                $result = $this->ItemModel->searchItem($key, $pharmId);
                //dnd($result);
                if ($result && !$result[0]->status){
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
                }else{
                    $status = $this->checkAvailability($value,-1);
                    $_SESSION['tempItemId'][$key] = $status;
                }               
            }
            //dnd( $_SESSION['tempItemId']);
            if(isset($_SESSION['tempItemId'])){
                foreach($_SESSION['removed'] as $rm){
                    if (key_exists($rm, $_SESSION['tempItemId'])) {
                        unset($_SESSION['tempItemId'][$rm]);
                    }
                    if (($k = array_search($rm, $_SESSION['removed'])) !== false) {
                        unset($_SESSION['removed'][$k]);
                    }
                    
                }
                $this->getItemModels(array_keys($_SESSION['tempItemId']));}     
            $this->view->render('search/prefilled_form');
            //dnd($this->view->items);
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
        $this->view->preId = -1;
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

    public function sendPrefilledFormAction($preId){
        if (!isset($_SESSION['tempItemId'])) {
            $_SESSION['tempItemId'] = [];
        }
        $itemId = $quan = [];
        $noOfItem = 0;
        
        foreach($_SESSION['tempItemId'] as $key=>$val){
            if (is_numeric($key)) {
                $noOfItem += 1;
            }
            array_push($itemId, $key);
            $quant = explode(',', $val)[0];
            array_push($quan, $quant);
        }
        $this->PrefilledformModel->update($preId, ['no_of_items'=>$noOfItem, 'itemIds'=>join(',',$itemId), 'quantities'=>join(',',$quan)]);
        $this->notifyCustomer($preId);
        $_SESSION['sentMsg'] = 'Succefully sent to customer';
        Router::redirect('PrescriptionHandler/view');

    }

    private function setPres($preId){
        if($preId != -1){
            $this->PrefilledformModel->findById($preId);
            $this->view->preId = $preId;
            $this->UserModel->findById($this->PrefilledformModel->customer_id);
            $this->view->customerName = $this->UserModel->name;
        }else{$this->view->preId = -1;}
    }

    private function notifyCustomer($refId){
        $this->MediatorModel->receivePrefilledfromsFromPrescription($refId);
    }

}