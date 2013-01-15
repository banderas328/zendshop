<?php

class Client_IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function listAction(){
        $manager = new Manager_Model_Managers();
        $manager_number =   $manager->manager_number();
        $model = new Client_Model_Client();
        $list = $model->show_clients($manager_number);
        $this->view->list =$list;


    }



}

