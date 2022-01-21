<?php

class Validate
{
    private $_passed = false, $_errors = [], $_db = null;

    public function __construct()
    {
        $this->_db = DB::getInstance(HOST,DB_NAME,DB_USER,DB_PASSWORD);
    }

    public function check($source, $items = [])
    {
        $this->_errors = [];

        foreach ($items as $item => $rules) {
            $item = Input::sanitize($item);
            $display = $rules['display'];
            foreach ($rules as $rule => $rule_value) {
                $value = Input::sanitize(trim($source[$item]));

                if ($rule === 'required' && empty($value)) {
                    $this->addError(["{$display} is required", $item]);
                } else if (!empty($value)) {
                    switch ($rule) {
                        case 'min':
                            if (strlen($value) < $rule_value) {
                                $this->addError(["{$display} must be a minimum of {$rule_value} characters.", $item]);
                            }
                            break;
                        case 'max':
                            if (strlen($value) > $rule_value) {
                                $this->addError(["{$display} must be a maximum of {$rule_value} characters.", $item]);
                            }
                            break;
                        case 'matches':
                            if ($value != $source[$rule_value]) {
                                $matchDisplay = $items[$rule_value]['display'];
                                $this->addError(["{$matchDisplay} and {$display} must match.", $item]);
                            }
                            break;
                        case 'unique':
                            $check = $this->_db->query("SELECT {$item} FROM {$rule_value} WHERE {$item} = ?", [$value]);

                            if ($check->count()) {
                                $this->addError(["{$display} is already exists. please choose another {$display}", $item]);
                            }
                            break;
                        case 'unique_update':
                            $t = explode(',', $rule_value);
                            $table = $t[0];
                            $id = $t[1];
                            $query = $this->_db->query("SELECT * FROM {$table} WHERE id != ? AND {$item} = ?", [$id, $value]);
                            if ($query->count()) {
                                $this->addError(["{$display} is already exists. please choose another {$display}", $item]);
                            }
                            break;
                        case 'is_numeric':
                            if (!is_numeric($value)) {
                                $this->addError(["{$display} has to be a number. please use a numeric value", $item]);
                            }
                            break;
                        case 'valid_email':
                            if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                                $this->addError(["{$display} must be a valid email address", $item]);
                            }
                            break;
                        case 'valid_contact':
                            // $contact_arr=explode('-',$value);
                            // if(count($contact_arr)!==2){
                            //     $this->addError(["{$display} must be in valid format (012-3456789)", $item]);
                            // }else{
                            //     if(strlen($contact_arr[0])!==3 || strlen($contact_arr[1])!==7 || !is_numeric($contact_arr[0]) || !is_numeric($contact_arr[1])){
                            //         $this->addError(["{$display} must be in valid format (012-3456789)", $item]);
                            //     }
                            // }
                            if (!self::checkPhoneNo($value)){
                                $this->addError(["{$display} can only contain 10 characters including numbers,- and spaces", $item]);
                            }
                            break;
                        case 'valid_idNo':
                            if (!self::checkIdNo($value)){
                                $this->addError(["Enter a valid {$display}", $item]);
                            }
                    }
                }
            }
        }

        if (empty($this->errors())){
            $this->_passed = true;
        }
        return $this;

        
    }

    public function errors() {
        return $this->_errors;
    }

    public function passed(){
        return $this->_passed;
    }

    public function displayErrors(){
        $html = '<ul class="bg-danger">';
        foreach ($this->_errors as $error){
            if (is_array($error)){
                $html  .= '<li class="text-danger">'.$error[0].'</li>';
                // $html .='<script>jQuery("document").ready(function(){jQuery("#'.$error[1].'").parent().closest("div").addClass("has-error");});</script>';
            }else{
                $html .= '<li class=text-danger>'.$error.'</li>';
            }
             
        }
        $html .='</ul>';
        return $html;
    }

    public function addError($error)
    {
        $this->_errors[] = $error;
        if (empty($this->_errors)) {
            $this->_passed = true;
        } else {
            $this->_passed = false;
        }
    }

    public static function checkPhoneNo($no){
        $no = str_replace(array('-'," "),'',$no);

        if (strlen($no) == 10 && is_numeric($no)) {
            return true;
        }else {
            return false;
        }
    }

    public static function checkIdNo($no){
        if (str_contains($no,'V') || str_contains($no,'v')){
            $no = trim($no);
            $no = substr($no,0,strlen($no)-1);
            if (strlen($no) == 9 && is_numeric($no)) {
                return true;
            }else {
                return false;
            }
        }else{
            if (strlen($no) == 12 && is_numeric($no)) {
                return true;
            }else {
                return false;
            }
        }
    }

    public function dateCheck($startDate,$endDate){
        if($startDate>=$endDate){
            $this->addError(["Ending Date must be after the Starting Date"]);
        }
        if($startDate < date('d/m/Y')){
            $this->addError(["Starting Date must be after the Current Date".date('Y/m/d')]);
        }
    }

    public function imageCheck($extention){
        if( $extention!= "jpg" && $extention != "png" && $extention != "jpeg" && $extention != "gif" ) {
            $this->addError(["Sorry, only JPG, JPEG, PNG & GIF files are allowed."]);
        }
    }
}
