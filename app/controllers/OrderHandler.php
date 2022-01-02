<?php
class OrderHandler extends Controller{
    public function __construct($controller,$action)
        {
            parent::__construct($controller,$action);
            $this->load_model('User');
            $this->load_model('Order');
        }

        public function loadOrderDetailsAction(){
            $this->view->render('order/orderDetails');
        }

        public function orderAction(){
            
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
}