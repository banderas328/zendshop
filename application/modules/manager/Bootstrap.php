<?php

class Manager_Bootstrap extends Zend_Application_Module_Bootstrap
{
    protected function _initAutoload()
    {
        $autoloader = new Zend_Application_Module_Autoloader(array(
            'namespace' => 'Manager_',
            'basePath' => dirname(__FILE__),
        ));

        // Add resource type for Module Api


        return $autoloader;
    }

}
