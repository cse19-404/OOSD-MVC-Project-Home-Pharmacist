<?php 
    
    class View{

        protected $_siteTitle=SITE_TITLE;

        public function __construct()
        {
             
        }

        public function render($viewName)  
        {
            $viewAry = explode('/',$viewName);
            $viewString = implode(DS,$viewAry);

            if (file_exists(ROOT.DS.'app'.DS.'views'.DS.$viewString.'.php')){
                include(ROOT.DS.'app'.DS.'views'.DS.$viewString.'.php');
            }else{
                include(ROOT.DS.'app'.DS.'views'.DS.'home'.DS.'404Error'.'.php');
                die();
            }

        }

        public function siteTitle()
        {
            return $this->_siteTitle;
        }

        public function setSiteTitle($title)
        {
            $this->_siteTitle = $title;
        }
        
    }
    

