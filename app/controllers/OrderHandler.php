<?php
class OrderHandler extends Controller{
    public function __construct($controller,$action)
        {
            parent::__construct($controller,$action);
            $this->load_model('User');
            $this->load_model('Pharmacy');
            $this->load_model('Order');
            //$this->load_model('PrefilledForm');
            $this->load_model('Mediator');
        }

        public function orderAction($preId, $detail=0, $history=0, $order=''){
            
            if($detail == 1){
                if ($history == 0) {
                    $strategy = "DirectOrder";
                    Router::route([$strategy, 'order', $preId, $this, $order]);
                    $this->view->render('order/orderDetails');
                }else{
                    $strategy = "HistoryOrder";
                    $preId = $history;
                    Router::route([$strategy, 'order', $preId, $this, $order]);
                }
                
            }else{
                $_SESSION['OrderDetails']['receiver_name'] = $_POST['receiver_name'];
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

        public function viewOrderAction($id,$msgId=-1){
            $order = new Order();
            $order->findById($id);
            $this->view->order = $order;
            $this->view->count = $order->no_of_items;
            $this->view->ids = explode(',', $order->items);
            $this->view->unit_prices = explode(',', $order->unit_prices);
            $this->view->quantities = explode(',', $order->quantities);
            $this->UserModel->findById($order->customer_id);
            $this->PharmacyModel->findById($order->pharmacy_id);
            $this->view->customerName = $this->UserModel->name;
            $this->view->pharmacyName = $this->PharmacyModel->name;
            for ($i=0; $i < $this->view->count; $i++) { 
                $item = new Item(DummyItem::getInstance($this->view->ids[$i]));
                $item->findById($this->view->ids[$i]);
                $this->view->items[] = $item;
            }
            if ($msgId != -1) {
                $this->MediatorModel->markAsRead($msgId);
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

        public function updateStatusAction($id, $seen=''){
            if($seen === 'seen'){
                $this->OrderModel->update($id,[
                    'status'=>'seen']);
                $this->notifyStatusUpdate($id, 'seen');
            }else{
                $this->OrderModel->update($id,[
                    'status'=>$_POST['status']
                ]);
                $this->notifyStatusUpdate($id,$_POST['status']);
            }
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
            // dnd($_SESSION['OrderDetails']);
            if(isset($_SESSION['OrderDetails'])){
                if($_SESSION['OrderDetails']['prescription']===NULL){
                    unset($_SESSION['OrderDetails']['prescription']);
                }
                $this->OrderModel->insert($_SESSION['OrderDetails']);
                $id = $this->OrderModel->getLastId();
                $this->MediatorModel->confirmOrder($id);
            }

            unsetSession(['OrderDetails','UserPharmacydetails','tempItemId', 'rawData', 'TotalPrice', 'removed']);
            if($_SESSION['role']==='customer'){
                Router::redirect('CustomerDashboard');
            } else{
                Router::redirect('PharmacyDashboard');
            }

            
        }

        private function notifyStatusUpdate($id,$status){
            $this->MediatorModel->receiveOrderStatusUpdate($id,$status);
        }

        public function deleteHistoryAction($id){
            $this->OrderModel->findById($id);
            $this->OrderModel->update($id,[
                'deleted'=>1
            ]);
            Router::redirect('CustomerDashboard/viewPurchaseHistory');
        }
}