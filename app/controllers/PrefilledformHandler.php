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
        $this->view->formId = $this->PrefilledformModel->getLastId()+1;
        $this->view->pharmId = $PharmId;
        //dnd($this->view->formId);
        $this->view->render('search/prefilled_form');
    }

    public function searchItemAction($formId, $PharmId){
        $results = $this->ItemModel->searchItem($_POST["item-name"], $PharmId);
        $this->view->result = $results;
        $this->getValues($formId, $PharmId);
        $this->view->processed = true;
        //dnd($this->view->result);
        if(isset($_SESSION['tempItemId'])){$this->getItemModels(array_keys($_SESSION['tempItemId']));}
        $this->view->render('search/prefilled_form');
    }

    public function addItemAction($itemId, $formId, $PharmId){
        if(isset($_SESSION['tempItemId'])){
            if(!in_array($itemId, $_SESSION['tempItemId'])){$_SESSION['tempItemId'][$itemId] = 0;}
        }else{$_SESSION['tempItemId'][$itemId] = 0;}
        //dnd($_SESSION['tempItemId']);
        $this->getValues($formId, $PharmId);
        $this->getItemModels(array_keys($_SESSION['tempItemId']));
        

        $this->view->render('search/prefilled_form');
    }

    public function addQuantityAction($itemId, $formId, $PharmId){
        $_SESSION['tempItemId'][$itemId] = $_POST['quantity'];
        $this->getValues($formId, $PharmId);
        $this->getItemModels(array_keys($_SESSION['tempItemId']));
        
        $this->view->render('search/prefilled_form');
    }

    private function getValues($formId, $PharmId){
        $this->PharmacyModel->findById($PharmId);
        $this->view->pharmName = $this->PharmacyModel->name;
        $this->view->formId = $formId;
        $this->view->pharmId = $PharmId;
    }

    private function getItemModels($idArr){
        $cond = '';
        foreach($idArr as $id){
            $cond .= 'id=' . $id . ' OR ';
        }
        $cond = rtrim($cond, ' OR ');
        //dnd($cond);
        $this->view->items = $this->ItemModel->find(['conditions'=>$cond]);
    }

}