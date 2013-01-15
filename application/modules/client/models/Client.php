<?php

class Client_Model_Client  extends Client_Model_DbTable_Clients
{

    public function show_clients() {
     $manager_model = new Manager_Model_Managers();
     $manager_number = $manager_model->manager_number();
     $dbAdapter = Zend_Db_Table::getDefaultAdapter();
     $select = $dbAdapter->select();
     $select->from("clients")->where("manager_number = ".$manager_number);
     $rows =   $dbAdapter->fetchAll($select);
     return $rows;
    }

    public function exclude_rows(array $client_list){

        $new_list = array();
        for ($i = 0 ;$i < count($client_list);$i++) {
            $new_list[] = array_slice($client_list[$i],0,3);
         }
       // var_dump($client_list);
      return $new_list;


    }

    public function clients_for_order()
    {
        $manager_model = new Manager_Model_Managers();
        $manager_number = $manager_model->manager_number();
        $select  = $this->_db->select()
            ->from($this->_name,
            array('key' => 'id','value' => 'first_name'));
        $select->where("manager_number = ".$manager_number);
        $result = $this->getAdapter()->fetchAll($select);



        return $result;
    }


}

