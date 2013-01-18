<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Anton_Zhavrid
 * Date: 1/14/13
 * Time: 4:27 AM
 * To change this template use File | Settings | File Templates.
 */
class Order_Form_Order extends Zend_Form
{

    public function init() {
        $translate = Default_IndexController::translateAction();
        $this->setAction("/order/index/index")->setMethod("post")
        ->setOptions(array("class" => "form-horizontal"));

       $product_name = new Zend_Form_Element_Text("product_name");
        $product_name->setLabel($translate->translate("product"))
            ->setOptions(array("size" => '30'))
            ->setRequired(true)
            ->addValidator('Alnum')
            ->addErrorMessages(array('notAlnum'=>$translate->translate("validator_not_alphanum")))
            ->addFilter('HtmlEntities')
            ->addFilter('StringTrim');

        $sum = new Zend_Form_Element_Text("sum");
        $sum->setLabel($translate->translate("sum"))
            ->setOptions(array("size" => '30'))
            ->setRequired(true)
            ->addValidator('Digits')
            ->addErrorMessages(array('notDigits'=>$translate->translate("validator_not_digits")))
            ->addFilter('HtmlEntities')
            ->addFilter('StringTrim');

        $price = new Zend_Form_Element_Text("price");
        $price->setLabel($translate->translate("price"))
            ->setOptions(array("size" => '30'))
            ->setRequired(true)
            ->addValidator('Digits')
            ->addErrorMessages(array('notDigits'=>$translate->translate("validator_not_digits")))
            ->addFilter('HtmlEntities')
            ->addFilter('StringTrim');

         $client_model = new Client_Model_Client();
        $client_list = $client_model->show_clients();
        $client_list = $client_model->clients_for_order();

        $client = new Zend_Form_Element_Select("client");
        $client->setLabel($translate->translate("select_client"));
        $client->addMultiOptions($client_list);
        $client->setRequired(true);
        $client->addValidator('Digits')
        ->addErrorMessages(array('notDigits'=> $translate->translate("hack")));
        $client->addFilter('HtmlEntities');





        $submit  =  new Zend_Form_Element_Submit("submit");
        $submit->setLabel($translate->translate("create_order"))
            ->setOptions(array("class" => "btn btn-warning"));

        $this->addElement($product_name)
            ->addElement($sum)
            ->addElement($price)
            ->addElement($client)
            ->addElement($submit);
    }

}
