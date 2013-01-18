<?php

class Default_LocaleController extends Zend_Controller_Action
{
public function indexAction(){


    if(Zend_Validate::is(
        $this->getRequest()->getParam("locale"),"InArray",array("haystack" => array("ru","en"))
    )){
    $session = new Zend_Session_Namespace('zendshop.locale');
        $session->locale = $this->getRequest()->getParam('locale');

    }
    $url = $_SERVER["HTTP_REFFERR"];
    $this->redirect($url);
}






}

