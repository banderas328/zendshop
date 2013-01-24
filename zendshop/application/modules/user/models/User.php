<?php

class User_Model_User
{
    public function create_user($array){
        $db_table = new User_Model_DbTable_Users();
        $db_table->insert($array);
    }

    public function Auth($login,$passowrd) {
        $auth       = Zend_Auth::getInstance();
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter);
        $authAdapter->setTableName('managers')
            ->setIdentityColumn('login')
            ->setCredentialColumn('password');
        // Set the input credential values
        $authAdapter->setIdentity($login);
       $authAdapter->setCredential(md5($passowrd));

        // Perform the authentication query, saving the result
        $result = $auth->authenticate($authAdapter);
        if($result->isValid()){

            $data = $authAdapter->getResultRowObject(null,'password');
            $auth->getStorage()->write($data);
           return true;
//            $this->redirect('index/index/index');
        }else{
            return false;
        }


    }

}

