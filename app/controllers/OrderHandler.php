<?php
class OrderHandler extends Controller{
    public function __construct($controller,$action)
        {
            parent::__construct($controller,$action);
            $this->load_model('User');
        }

        public function loadOrderDetailsAction($change=''){
            if($change!='change'){
                $items='';
                $quantities='';
                $unit_prices='';
                $no_of_items=0;
                foreach($_SESSION['tempItemId'] as $itemId=>$value){
                    if(str_contains($value,'In Stock')){
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

                //$customer_id = ;
                $user_id= $_SESSION['UserPharmacydetails']["UserId"];
                $total = $_SESSION['TotalPrice'];

                $_SESSION['OrderDetails']=['pharmacy_id'=>$_SESSION['UserPharmacydetails']["PharmId"],];
            }
            $this->view->change = $change;
            
            $this->view->render('order/orderDetails');
        }

        public function orderAction($pharmId){
        }
}