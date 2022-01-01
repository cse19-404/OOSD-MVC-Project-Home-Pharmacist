<?php
class OrderHandler extends Controller{
    public function __construct($controller,$action)
        {
            parent::__construct($controller,$action);
            $this->load_model('User');
        }

        public function loadOrderDetailsAction(){
            $this->view->render('order/orderDetails');
        }

        public function orderAction(){
            
        }
}