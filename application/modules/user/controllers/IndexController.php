<?php

class User_IndexController extends Zend_Controller_Action
{
    public function loginAction(){
      if(count($this->_helper->flashMessenger->getMessages())) $this->view->message = $this->_helper->flashMessenger->getMessages() ;
      $this->_helper->layout()->disableLayout();
      $form = new User_Form_Login();
      $this->view->form = $form;
     // $this->view->translate = Custom_Base::translateAction();
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
             $urlOptions = array("module" => "user" ,'controller'=>'index', 'action'=>'login' );
             $this->_helper->redirector->gotoRoute($urlOptions);

             $this->redirect("/user/index/login");
        }
        else {
            $urlOptions = array("module" => "client" ,'controller'=>'index', 'action'=>'list' );
            $this->_helper->redirector->gotoRoute($urlOptions);
            $this->redirect("/client/index/list");
        }
	}


}

