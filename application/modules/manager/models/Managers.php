<?php

class Manager_Model_Managers  extends Manager_Model_DbTable_Managers
{
    public function manager_number(){
        $auth = Zend_Auth::getInstance();
        $manager_number =  $auth->getIdentity()->number;
        return $manager_number;
    }

}

