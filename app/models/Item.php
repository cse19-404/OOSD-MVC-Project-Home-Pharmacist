<?php 
class Item extends Model{

    protected $id;
    protected $dummyItem;
    
    public function __construct($dummyItem)
    {
        $this->id = $dummyItem->getId();
        $table = 'itemtable';
        parent::__construct($table);
    }


    public function deleteItem($id){
        $this->update($id,['status'=> 1]);
    }

}