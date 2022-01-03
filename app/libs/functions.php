<?php 

    require_once(ROOT.DS.'app'.DS.'libs'.DS.'helpers.php');

    function distance($lat1, $lon1, $lat2, $lon2) {
        if (($lat1 == $lat2) && ($lon1 == $lon2)) {
            return 0;
        }
        else {
            $theta = $lon1 - $lon2;
            $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;            
            return ($miles * 1.609344);
        }
    }

    function unsetSession($varArray){
        if($varArray==="all"){
            $varArray = array_keys($_SESSION);           
        }
        foreach($varArray as $varName){
            if(!($varName === 'multiton' ||  $varName === 'username' || $varName === 'role' || $varName === CURRENT_USER_SESSION_NAME)){
                if(isset($_SESSION[$varName])){
                    unset($_SESSION[$varName]);
                }
            }      
        }
        //dnd($_SESSION);
    }
        
