<?php

class Order_Model_Order
{
public function create_order(array $data){

$primary_table = new Order_Model_DbTable_Order();
$secondary_table = new Order_Model_DbTable_OrderChild();

    $data_for_primary = array(
        'sum' => $data["sum"],
        'date'      => new Zend_Db_Expr('CURDATE()'),
        'client_code'      => $data["client"]
    );
    $primary_table->insert($data_for_primary);

    $data_for_secondary = array(
        "order_id" => $primary_table->getAdapter()->lastInsertId(),
        "product_name" => $data["product_name"],
        'price' => $data["price"],
    );
    $secondary_table->insert($data_for_secondary);

    return true;

}

public function order_list($client_code){

    $dbAdapter = Zend_Db_Table::getDefaultAdapter();
    $select = $dbAdapter->select();
    $select->from("order")
        ->joinLeft(array("orders_child"),'order.id = orders_child.order_id')
        ->where("order.client_code = ".$client_code);
    $rows =   $dbAdapter->fetchAll($select);
    return $rows;



}

}

