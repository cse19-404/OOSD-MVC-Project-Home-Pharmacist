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

    public function searchItem($itemName, $pharmId){
        $resItems = [];
        $results = $this->_db->find($this->_table, ['conditions'=>'pharmacy_id=?', 'bind'=>[$pharmId]]);
        foreach($results as $row){
            if(str_contains(strtoupper($row->name),strtoupper($itemName))){
                $resItems[] = $row;
            }
        }
        return $resItems;
    }

    public function getId(){
        return $this->id;
    }

}