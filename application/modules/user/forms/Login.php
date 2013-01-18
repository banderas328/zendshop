<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Anton_Zhavrid
 * Date: 1/14/13
 * Time: 4:27 AM
 * To change this template use File | Settings | File Templates.
 */
class User_Form_Login extends Zend_Form
{

    public function init() {
        $translate = Default_IndexController::translateAction();
        $this->setAction("/user/index/auth")->setMethod("post")
        ->setOptions(array("class"=>"form-horizontal"));

        $username = new Zend_Form_Element_Text("username");
        $username->setLabel($translate->translate("form_login"))
            ->setOptions(array("size" => '30'))
            ->setRequired(true)
            ->addValidator('Alnum')
            ->addFilter('HtmlEntities')
            ->addFilter('StringTrim');

        $password = new Zend_Form_Element_Password("password");
        $password->setLabel($translate->translate("form_password"))
            ->setOptions(array("size" => 30))
            ->setRequired(true)
            ->addFilter('HtmlEntities')
            ->addFilter('StringTrim');

        $submit  =  new Zend_Form_Element_Submit("submit");
        $submit->setLabel($translate->translate("form_login_submit"))
            ->setOptions(array("class" => "btn btn-warning"));

        $this->addElement($username)
            ->addElement($password)
            ->addElement($submit);
    }

}
