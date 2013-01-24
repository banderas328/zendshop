<?php

class User_IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
       $db_table_user = new User_Model_User();
       $db_table_user->create_user(array(
            "name" => "Bob"
       ));
    }

    public function loginAction(){
      $form = new User_Form_Login();
      $this->view->form = $form;
    }

    public function authAction(){

        $request    = $this->getRequest();
        $login = $request->getParam('username');
        $password = $request->getParam('password');
        $model = new User_Model_User();
        if($model->Auth($login,$password) != true) {
          $this->redirect("/user/index/login");
        }
        else {

            $this->redirect("/client/index/list");
        }
	}


}

