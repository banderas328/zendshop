<?php

class User_IndexController extends Custom_Base
{
    public function loginAction(){
      if(count($this->_helper->flashMessenger->getMessages())) $this->view->message = $this->_helper->flashMessenger->getMessages() ;
      $form = new User_Form_Login();
      $this->view->form = $form;
      $this->view->translate = Custom_Base::translateAction();
    }

    public function authAction(){
        $translate = Custom_Base::translateAction();
        $request    = $this->getRequest()->getParams();
        $login = $request['username'];
        $password = $request['password'];
        $model = new User_Model_User();
         if($model->Auth($login,$password) != true) {
             $flashMessenger = $this->_helper->getHelper('FlashMessenger');
             $flashMessenger->addMessage($translate->translate("access_denied"));
             $this->redirect("/user/index/login");
        }
        else {
          $this->redirect("/client/index/list");
        }
	}


}

