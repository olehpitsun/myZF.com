<?php

class Plugin_Acl extends Zend_Controller_Plugin_Abstract
{

    private $_controller = array(
        'controller' => 'error',
        'action' => 'denied'
    );
    public function preDispatch(Zend_Controller_Request_Abstract $request)
    {

        $auth =  Zend_Auth::getInstance();
        $acl = Zend_Registry::get('acl');

        if($auth->hasIdentity())
        {
            $role = $auth->getIdentity()->role;
        }
        else
        {
            $role = 'guest';
        }

        if(!$acl->hasRole($role))
        {
            $role = 'guest';
        }

        $controller = $request->controller;
        $action = $request->action;

        if(!$acl->has($controller))
        {
            $controller = null;
        }

        if(!$acl->isAllowed($role, $controller, $action))
        {
            $request->setControllerName($this->_controller["controller"]);
            $request->setActionName($this->_controller["action"]);
        }
    }
}
?>
