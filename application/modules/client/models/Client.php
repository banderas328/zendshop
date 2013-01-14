<?php

class Client_Model_Client  extends Client_Model_DbTable_Clients
{

    public function show_clients($manager_number) {
     $dbAdapter = Zend_Db_Table::getDefaultAdapter();
     $select = $dbAdapter->select();
     $select->from("clients")->where("manager_number = ".$manager_number);
     $rows =   $dbAdapter->fetchAll($select);
     return $rows;
    }


}

