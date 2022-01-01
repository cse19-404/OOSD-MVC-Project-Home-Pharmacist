<?php
class DirectOrder extends Controller implements Strategy{
    public function __construct($controller,$action)
        {
            parent::__construct($controller,$action);
            $this->load_model('User');
        }

        public function orderAction(){

        }
}