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

        $this->setAction("/order/index/index")->setMethod("post");

        $product_name = new Zend_Form_Element_Text("product_name");
        $product_name->setLabel("Product:")
            ->setOptions(array("size" => '30'))
            ->setRequired(true)
            ->addValidator('Alnum')
            ->addFilter('HtmlEntities')
            ->addFilter('StringTrim');

        $sum = new Zend_Form_Element_Text("sum");
        $sum->setLabel("Sum:")
            ->setOptions(array("size" => '30'))
            ->setRequired(true)
            ->addValidator('Alnum')
            ->addFilter('HtmlEntities')
            ->addFilter('StringTrim');

        $price = new Zend_Form_Element_Text("price");
        $price->setLabel("Price:")
            ->setOptions(array("size" => '30'))
            ->setRequired(true)
            ->addValidator('Alnum')
            ->addFilter('HtmlEntities')
            ->addFilter('StringTrim');

         $client_model = new Client_Model_Client();
        $client_list = $client_model->show_clients();
        $client_list = $client_model->clients_for_order();

        $client = new Zend_Form_Element_Select("client");
        $client->setLabel("Select Client");
        $client->addMultiOptions($client_list);
        $client->setRequired(true);
        $client->addValidator('Digits');
        $client->addFilter('HtmlEntities');





        $submit  =  new Zend_Form_Element_Submit("submit");
        $submit->setLabel("Create Order")
            ->setOptions(array("class" => "submit"));

        $this->addElement($product_name)
            ->addElement($sum)
            ->addElement($price)
            ->addElement($client)
            ->addElement($submit);
    }

}
