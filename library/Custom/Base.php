<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Anton_Zhavrid
 * Date: 1/25/13
 * Time: 4:42 AM
 * To change this template use File | Settings | File Templates.
 */
class Custom_Base extends Zend_Controller_Action {

    public function preDispatch(){
        if (!Zend_Auth::getInstance()->hasIdentity() && ($this->getRequest()->getActionName() != "locale")){$this->redirect("/user/index/login");}
        $layout = Zend_Layout::getMvcInstance();
        $view = $layout->getView();
        $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('viewRenderer');
        $viewRenderer->initView();
        $viewRenderer->view->doctype('XHTML1_STRICT');
        if($this->_request->isXmlHttpRequest()){  $this->_helper->layout()->disableLayout();}


        $view->translate = $this->translateAction();
    }


    public function localeAction(){
        if(Zend_Validate::is(
            $this->getRequest()->getParam("locale"),"InArray",array("haystack" => array("ru","en"))
        )){
            $session = new Zend_Session_Namespace('zendshop.locale');
            $session->locale = $this->getRequest()->getParam('locale');
        }
        $url = $_SERVER["HTTP_REFERER"];
        $this->redirect($url);
    }
    public static function translateAction(){
        $translate = new Zend_Translate_Adapter_Array(APPLICATION_PATH."/../languages/messages.en.php","en");
        $translate->addTranslation(APPLICATION_PATH."/../languages/messages.ru.php","ru");
        $translate->setLocale(Zend_Registry::get("Zend_Locale"));
        $registry = Zend_Registry::getInstance();
        $registry->set('Zend_Translate',$translate);
        return $translate;
    }





}