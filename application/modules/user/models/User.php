<?php

class User_Model_User
{


    public function Auth($login,$passowrd) {
        $auth       = Zend_Auth::getInstance();
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter);
        $authAdapter->setTableName('managers')
            ->setIdentityColumn('login')
            ->setCredentialColumn('password');
       $authAdapter->setIdentity($login);
       $authAdapter->setCredential(md5($passowrd));
        $result = $auth->authenticate($authAdapter);
        if($result->isValid()){
            $data = $authAdapter->getResultRowObject(null,'password');
            $auth->getStorage()->write($data);
           return true;
        }else{

            return false;
        }


    }

}

