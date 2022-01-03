<?php
class OrderHandler extends Controller{
    public function __construct($controller,$action)
        {
            parent::__construct($controller,$action);
            $this->load_model('User');
            $this->load_model('Order');
            $this->load_model('PrefilledForm');
        }

        // public function loadOrderDetailsAction($preId,$change=''){
        //     if($change!='change'){
        //         $prescription = NULL;
        //         if($preId != -1){
        //             $this->PrefilledFormModel->findById($preId);
        //             $prescription = $this->PrefilledFormModel->prescription;
        //         }
        //         $items='';
        //         $quantities='';
        //         $unit_prices='';
        //         $no_of_items=0;
        //         foreach($_SESSION['tempItemId'] as $itemId=>$value){
        //             if(str_contains($value,'In Stock')){
        //                 $no_of_items++;
        //                 $values = explode(",",$_SESSION['tempItemId'][$itemId]);
        //                 $items = $items.','.$itemId;
        //                 $quantities = $quantities.','.$values[0];
        //                 $item = new Item(DummyItem::getInstance($itemId));
        //                 $item->findById($itemId);
        //                 $unit_prices = $unit_prices.','.$item->price_per_unit_quantity;
        //             }      
        //         }
        //         $items=ltrim($items,',');
        //         $quantities=ltrim($quantities,',');
        //         $unit_prices=ltrim($unit_prices,',');

        //         $_SESSION['OrderDetails']=[
        //             'pharmacy_id' => $_SESSION['UserPharmacydetails']["PharmId"],
        //             'customer_id' => $_SESSION['UserPharmacydetails']["UserId"],
        //             'no_of_items' => $no_of_items,
        //             'items' => $items,
        //             'unit_prices' => $unit_prices,
        //             'quantities' => $quantities,
        //             'total' => $_SESSION['TotalPrice'],
        //             'prescription' => $prescription,
        //             'status' => 'new'
        //         ];
        //     }
        //     $this->view->preId= $preId;
        //     $this->view->change = $change;          
        //     $this->view->render('order/orderDetails');
        // }

        public function orderAction($preId, $detail=0, $history=0, $order=''){
            if($detail == 1){
                $strategy = ($history == 1)? "HistoryOrder": "DirectOrder";
                Router::route([$strategy, 'order', $preId, $order, $this]);
                $this->view->render('order/orderDetails');
            }else{
                $_SESSION['OrderDetails']['reciever_name'] = $_POST['reciever_name'];
                $_SESSION['OrderDetails']['address'] = $_POST['address'];
                $_SESSION['OrderDetails']['mobile_number'] = $_POST['mobile_number'];

                $this->view->count = $_SESSION['OrderDetails']['no_of_items'];
                $this->view->ids = explode(',', $_SESSION['OrderDetails']['items']);
                $this->view->unit_prices = explode(',', $_SESSION['OrderDetails']['unit_prices']);
                $this->view->quantities = explode(',', $_SESSION['OrderDetails']['quantities']);
                $this->view->customerName = $_SESSION['UserPharmacydetails']["CustomerName"];
                for ($i=0; $i < $this->view->count; $i++) { 
                    $item = new Item(DummyItem::getInstance($this->view->ids[$i]));
                    $item->findById($this->view->ids[$i]);
                    $this->view->items[] = $item;
                }
                $this->view->render('order/confirmOrder');
            }
            
        }

        public function viewAction(){
            $status ="";
            $this->view->filter = 'All';
            if (isset($_POST['filter-status'])){
                $status = $_POST['filter-status'];
                $this->view->filter = $status;
            }
            $status = $status === 'All' ? '':$status;
            $results = $this->OrderModel->getfilteredData($status);
            $this->view->results = $results;
            $this->view->results =[];
            foreach($results as $result){
                $user = new User();
                $user->findById($result->customer_id);
                $this->view->results [$result->id] = [$user,$result];
            }
            $this->view->render('order/viewOrders');
        }

        public function viewOrderAction($id){
            $order = new Order();
            $order->findById($id);
            $this->view->order = $order;
            $this->view->count = $order->no_of_items;
            $this->view->ids = explode(',', $order->items);
            $this->view->unit_prices = explode(',', $order->unit_prices);
            $this->view->quantities = explode(',', $order->quantities);
            $this->UserModel->findById($order->customer_id);
            $this->view->customerName = $this->UserModel->name;
            for ($i=0; $i < $this->view->count; $i++) { 
                $item = new Item(DummyItem::getInstance($this->view->ids[$i]));
                $item->findById($this->view->ids[$i]);
                $this->view->items[] = $item;
            }
            $this->view->render('order/orderstatuschange');
        }

        public function closeOrderAction($id){
            $this->OrderModel->findById($id);
            $this->OrderModel->update($id,[
                'closed'=>1
            ]);
            Router::redirect('OrderHandler/view');
        }

        public function updateStatusAction($id){
            $this->OrderModel->update($id,[
                'status'=>$_POST['status']
            ]);
            Router::redirect('OrderHandler/view');
        }

        public function cancelOrderAction(){
            
            unsetSession(['OrderDetails','UserPharmacydetails','tempItemId', 'rawData', 'TotalPrice', 'removed']);
            if($_SESSION['role']==='customer'){
                Router::redirect('CustomerDashboard');
            } else{
                Router::redirect('PharmacyDashboard');
            }  
        }

        public function confirmOrderAction(){
            //dnd($_SESSION['OrderDetails']);
            if(isset($_SESSION['OrderDetails'])){
                if($_SESSION['OrderDetails']['prescription']===NULL){
                    unset($_SESSION['OrderDetails']['prescription']);
                }
                $this->OrderModel->insert($_SESSION['OrderDetails']);
            }

            unsetSession(['OrderDetails','UserPharmacydetails','tempItemId', 'rawData', 'TotalPrice', 'removed']);
            if($_SESSION['role']==='customer'){
                Router::redirect('CustomerDashboard');
            } else{
                Router::redirect('PharmacyDashboard');
            }

            
        }
}