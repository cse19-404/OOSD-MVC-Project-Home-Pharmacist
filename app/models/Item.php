<?php 

class Item extends Model{
    
    public function __construct()
    {
        $table = 'itemtable';
        parent::__construct($table);
    }

    public function saveApplication($params){
        $target_dir = 'uploads/';
        $target_file = $target_dir . basename($_FILES["documents"]["name"]);
        if (isset($params['delivery_supported']) && $params['delivery_supported']=="on"){
            $params['delivery_supported'] = 1;
        }else{
            $params['delivery_supported'] = 0;
        }
        $arr = array("documents"=>$target_file , "application_status"=>"pending", "acc_created"=>0, "deleted"=>0);
        if(move_uploaded_file($_FILES["documents"]["tmp_name"], $target_file))
        {
            $params = array_merge($params,$arr);
            $this->assign($params);
            $this->save();        
        }else
        {
            echo ("Sorry, there was an error uploading your file.");
        }

    }

    public function changeStatus($id,$status){
        $this->_db->update($this->_table,$id,[
            'application_status'=>$status
        ]);
    }

    public function deleteApplication($id){
        $this->_db->update($this->_table,$id,[
            'deleted'=>1
        ]);
    }
}