<?php

class Default_IndexController extends Zend_Controller_Action
{

     public function preDispatch(){
       if (!Zend_Auth::getInstance()->hasIdentity()){$this->redirect("/user/index/login");}
         $layout = Zend_Layout::getMvcInstance();
         $view = $layout->getView();
         $view->translate = $this->translateAction();
     }

    public static function translateAction(){
        $translate = new Zend_Translate_Adapter_Array(APPLICATION_PATH."/../languages/messages.en.php","en");
        $translate->addTranslation(APPLICATION_PATH."/../languages/messages.ru.php","ru");
        $translate->setLocale(Zend_Registry::get("Zend_Locale"));
        return $translate;
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


}

