<?php

class DummyItem{
    private $id;
    private function __construct($id)
    {
        $this->id = $id;
    }

    public function getId(){
        return $this->id;
    }

    public static function getInstance($id){
        if(!key_exists($id, (array)self::getMultiton())){
            $_SESSION['multiton'][$id] = new DummyItem($id);
        }
        return $_SESSION['multiton'][$id];
    }

    public static function getMultiton(){
        return $_SESSION['multiton'];
    }
}

?>