<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected $_front;


    public function _initAutoload()
    {
        $loader = Zend_Loader_Autoloader::getInstance();

        //or for multiple namespaces
        $loader->registerNamespace(array('Custom_',));
    }
    protected function _bootstrap()
    {
        $autoloader = Zend_Loader_Autoloader::getInstance();
        $autoloader->registerNamespace('Custom_');
        $front = Zend_Controller_Front::getInstance();
        $acl = new Custom_Acl();
        $front->registerPlugin(new $acl);


    }

}

