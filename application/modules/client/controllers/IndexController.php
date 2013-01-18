<?php
require_once APPLICATION_PATH."/modules/default/controllers/IndexController.php";
class Client_IndexController extends Default_IndexController
{



    public function listAction(){
        $translate = Default_IndexController::translateAction();
        $manager = new Manager_Model_Managers();
        $manager_number =   $manager->manager_number();
        $model = new Client_Model_Client();
        $list = $model->show_clients($manager_number);
        $this->view->translate =$translate;
        $this->view->list =$list;
    }



}

