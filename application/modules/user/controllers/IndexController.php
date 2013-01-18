<?php
require_once APPLICATION_PATH."/modules/default/controllers/IndexController.php";
class User_IndexController extends Default_IndexController
{




    public function loginAction(){
      if(count($this->_helper->flashMessenger->getMessages())) $this->view->message = $this->_helper->flashMessenger->getMessages() ;
      $form = new User_Form_Login();
      $this->view->form = $form;
    }

    public function authAction(){
        $translate = Default_IndexController::translateAction();
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

