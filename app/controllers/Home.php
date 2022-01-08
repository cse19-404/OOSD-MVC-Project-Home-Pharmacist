<?php 

    class Home extends Controller{

        public function __construct($controller,$action)
        {
            parent::__construct($controller,$action);
        }

        public function indexAction ()
        {
            Session::delete();
            $this->view->render('home/index');
        }

        
    }
