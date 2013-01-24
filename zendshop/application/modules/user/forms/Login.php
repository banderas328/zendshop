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

        $this->setAction("/user/index/auth")->setMethod("post");

        $username = new Zend_Form_Element_Text("username");
        $username->setLabel("Username:")
            ->setOptions(array("size" => '30'))
            ->setRequired(true)
            ->addValidator('Alnum')
            ->addFilter('HtmlEntities')
            ->addFilter('StringTrim');

        $password = new Zend_Form_Element_Password("password");
        $password->setLabel("Password:")
            ->setOptions(array("size" => 30))
            ->setRequired(true)
            ->addFilter('HtmlEntities')
            ->addFilter('StringTrim');

        $submit  =  new Zend_Form_Element_Submit("submit");
        $submit->setLabel("Log In")
            ->setOptions(array("class" => "submit"));

        $this->addElement($username)
            ->addElement($password)
            ->addElement($submit);
    }

}
