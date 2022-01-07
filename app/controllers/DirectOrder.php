<?php
class DirectOrder extends Controller implements Strategy{
    public function __construct($controller,$action)
        {
            parent::__construct($controller,$action);
            //$this->load_model('User');
            $this->load_model('PrefilledForm');
        }

        public function orderAction($preId, $handler, $change=''){
            if($change!='change'){
                $prescription = NULL;
                if($preId != -1 && !isset($_SESSION['orderfromPharm'])){
                    $this->PrefilledFormModel->findById($preId);
                    $prescription = $this->PrefilledFormModel->prescription;
                }
                $items='';
                $quantities='';
                $unit_prices='';
                $no_of_items=0;
                foreach($_SESSION['tempItemId'] as $itemId=>$value){
                    if((str_contains($value,'In Stock') || str_contains($value,'Prescription Needed')) && explode(',', $value)[0] !== '-'){
                        $no_of_items++;
                        $values = explode(",",$_SESSION['tempItemId'][$itemId]);
                        $items = $items.','.$itemId;
                        $quantities = $quantities.','.$values[0];
                        $item = new Item(DummyItem::getInstance($itemId));
                        $item->findById($itemId);
                        $unit_prices = $unit_prices.','.$item->price_per_unit_quantity;
                    }      
                }
                $items=ltrim($items,',');
                $quantities=ltrim($quantities,',');
                $unit_prices=ltrim($unit_prices,',');

                $_SESSION['OrderDetails']=[
                    'pharmacy_id' => $_SESSION['UserPharmacydetails']["PharmId"],
                    'customer_id' => $_SESSION['UserPharmacydetails']["UserId"],
                    'no_of_items' => $no_of_items,
                    'items' => $items,
                    'unit_prices' => $unit_prices,
                    'quantities' => $quantities,
                    'total' => $_SESSION['TotalPrice'],
                    'prescription' => $prescription,
                    'status' => 'new'
                ];
            }
            $handler->view->preId= $preId;
            $handler->view->change = $change;          
            // $this->view->render('order/orderDetails');
        }
}