<?php

class Client_IndexController extends Custom_Base
{

    public function listAction(){
        $manager = new Manager_Model_Managers();
        $manager_number =   $manager->manager_number();
        $model = new Client_Model_Client();
        $list = $model->show_clients($manager_number);
        $this->view->list =$list;
    }



}

