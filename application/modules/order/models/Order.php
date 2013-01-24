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
    $client_code = $dbAdapter->quote($client_code);
    $select = $dbAdapter->select();
    $select->from("order")
        ->joinLeft(array("orders_child"),'order.id = orders_child.order_id')
        ->where("order.client_code = ".$client_code);
    $rows =   $dbAdapter->fetchAll($select);
    return $rows;



}

    public function country_list() {
        $db = Zend_Db_Table::getDefaultAdapter();
        $sql = "SELECT country, count( client_code ) AS number
                FROM clients
                JOIN `order` ON clients.id = order.client_code
                GROUP BY country
                ORDER BY number DESC";
        $rows = $db->fetchAll($sql);
        return $rows;
    }

    public function orderscountry_list($country){

        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $country = $dbAdapter->quote($country);
        $sql = "SELECT *
        FROM clients
        JOIN `order` ON clients.id = order.client_code
        JOIN `orders_child` ON order.id = orders_child.order_id
        WHERE clients.country = ".$country.";";
        $rows =   $dbAdapter->fetchAll($sql);
        return $rows;
    }
    public function orderscity_list($city){

        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $city = $dbAdapter->quote($city);
        $sql = "SELECT *
        FROM clients
        JOIN `order` ON clients.id = order.client_code
        JOIN `orders_child` ON order.id = orders_child.order_id
        WHERE clients.city = ".$city.";";
        $rows =   $dbAdapter->fetchAll($sql);
        return $rows;
    }
    public function ordercityes_list(){

        $db = Zend_Db_Table::getDefaultAdapter();
        $sql = "SELECT city, sum( sum ) AS order_sum
        FROM clients
        JOIN `order` ON clients.id = order.client_code
        GROUP BY city
        ORDER BY order_sum DESC";
        $rows = $db->fetchAll($sql);
        return $rows;


    }


}

