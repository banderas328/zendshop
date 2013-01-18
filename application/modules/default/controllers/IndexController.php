<?php

class Default_IndexController extends Zend_Controller_Action
{


     public function preDispatch(){

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


}

