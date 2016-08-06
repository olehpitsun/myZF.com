<?php
class Model_Auth extends  Zend_Db_Table_Abstract
{
    protected $_name = 'users';

    public function authorize($username,$password)
    {
        $auth = Zend_Auth::getInstance();
        $authAdapter = new Zend_Auth_Adapter_DbTable(Zend_Db_Table::getDefaultAdapter(),
            'users',
            'username',
            'password',
            'sha(?)'
        );

        $authAdapter->setIdentity($username)->setCredential($password);
        $result = $auth->authenticate($authAdapter);
        if($result->isValid())
        {
            $storage = $auth->getStorage();
            $storage->write($authAdapter->getResultRowObject(null, array('password')));
            return true;
        }
        return false;
    }
}
?>