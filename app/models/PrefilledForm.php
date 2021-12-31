<?php 

class PrefilledForm extends Model{
    
    public function __construct()
    {
        $table = 'prefilledformtable';
        parent::__construct($table);
    }


}