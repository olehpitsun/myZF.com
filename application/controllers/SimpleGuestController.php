<?php

/**
 * Created by PhpStorm.
 * User: oleh
 * Date: 10.05.16
 * Time: 9:41
 */
class SimpleguestController extends Zend_Controller_Action
{
    public function indexAction()
    {
        $simpleGuestbook = new Application_Model_SimpleGuestMapper();
        $this->view->entries = $simpleGuestbook->fetchAll();
    }
}


