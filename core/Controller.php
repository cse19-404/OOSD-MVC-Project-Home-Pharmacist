<?php

class Controller
{
    protected $_controller, $_action;
    public $view;

    public function __construct($controller, $action)
    {
        $this->_controller = $controller;
        $this->_action = $action;
        $this->view = new View();
    }

    protected function load_model($model,$id=-2){
        if (class_exists($model)){
            if($id==-2){
                $this->{$model.'Model'} = new $model();
            } else{
                $this->{$model.'Model'} = new $model(DummyItem::getInstance($id));
            }        
        }
    }
}
