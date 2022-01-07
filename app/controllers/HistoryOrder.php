<?php
class HistoryOrder extends Controller implements Strategy{
    public function __construct($controller,$action)
        {
            parent::__construct($controller,$action);
            //$this->load_model('User');
            $this->load_model('Order');
        }

        public function orderAction($preId, $handler, $change=''){
            if($change === 'history'){
                if (isset($_SESSION['tempItemId'])){
                    unset($_SESSION['tempItemId']);
                }
                $this->OrderModel->findById($preId);
                
                $itemIds = explode(',', $this->OrderModel->items);
                $itemQuants = explode(',', $this->OrderModel->quantities);
                if (isset($_SESSION['rawData'])){
                    unset($_SESSION['rawData']);
                }
                $i = 0;
                foreach($itemIds as $id){
                    if(is_numeric($id)){
                        $item = new Item(DummyItem::getInstance($id));
                        $item->findById($id);
                        $_SESSION['rawData'][$item->name] = $itemQuants[$i];
                    }else{
                        $_SESSION['rawData'][$id] = '0';
                    }
                    $i++;
                }
                Router::route(['PrefilledformHandler', 'processItems', $this->OrderModel->pharmacy_id, -1, 0-($this->OrderModel->id - 1)]);
            }
        }
}