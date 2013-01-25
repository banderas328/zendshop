<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected function _initLocale(){
        $session = new Zend_Session_Namespace("zendshop.locale");
        if($session->locale){

            $locale = new Zend_locale($session->locale);
        }
        if (!isset($locale)){
            $locale = "ru";
        }
        $registry = Zend_Registry::getInstance();
        $registry->set("Zend_Locale",$locale);
    }
    protected function _initConfig()
    {
        $config = new Zend_Config($this->getOptions());
        Zend_Registry::set('config', $config);
    }

}

