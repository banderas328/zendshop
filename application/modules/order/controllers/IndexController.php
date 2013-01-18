<?php
require_once APPLICATION_PATH."/modules/default/controllers/IndexController.php";
class Order_IndexController extends Default_IndexController
{



    public function indexAction()
    {
        $translate = Default_IndexController::translateAction();
        $form = new Order_Form_Order();
        if ($this->_request->isPost())
        {
            if ($form->isValid($this->_request->getPost()))
            {
                $model = new Order_Model_Order();
                if($model->create_order($this->_request->getPost())){$this->view->order_message = $translate->translate("create_order");}
            }
        }
        $this->view->form = $form;
    }

    public function orderlistAction(){
        $translate = Default_IndexController::translateAction();
        $this->_helper->layout()->disableLayout();
        $model = new Order_Model_Order();
        $list = $model->order_list(mysql_escape_string($this->_request->getParam("client")));
        if(count($list) > 0 ){
        $this->view->translate = $translate;
        $this->view->list = $list;
        }
        else {die ($translate->translate("have_no_orders"));}
    }


}

