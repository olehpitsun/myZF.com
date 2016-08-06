<?php

class AuthController extends Zend_Controller_Action
{

    public function indexAction()
    {
        $this->_helper->redirector('index', 'index');
    }

   public function loginAction()
   {
       $form = new Form_Login();
       $this->view->form = $form;

       if ($this->getRequest()->isPost()) {
           $formData = $this->getRequest()->getPost();
           if ($form->isValid($formData)) {
                $user = new Model_Auth();
               if($user->authorize($form->getValue('username'),$form->getValue('password')))
               {
                   $this->_helper->redirector('index', 'index');
               }
           }
       }
   }

    public function logoutAction(){
        $auth = Zend_Auth::getInstance();
        $auth-> clearIdentity();
        $this->_helper->redirector('login', 'auth');
    }
}
?>