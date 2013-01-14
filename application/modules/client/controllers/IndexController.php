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
        $auth = Zend_Auth::getInstance();
        $manager_number =  $auth->getIdentity()->number;
        $model = new Client_Model_Client();
        $list = $model->show_clients($manager_number);
        $this->view->list =$list;


    }


}

