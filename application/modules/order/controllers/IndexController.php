<?php

class Order_IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $form = new Order_Form_Order();
        if ($this->_request->isPost())
        {
            if ($form->isValid($this->_request->getPost()))
            {
                die("cool");
            }
        }

        $this->view->form = $form;

    }

    public function orderAction(){






    }


}

