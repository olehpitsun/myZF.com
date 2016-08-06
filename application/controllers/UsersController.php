<?php

/**
 * Created by PhpStorm.
 * User: oleh
 * Date: 10.05.16
 * Time: 14:36
 */
class UsersController extends Zend_Controller_Action
{

    public function init(){$this->_helper->getHelper('AjaxContext')->initContext('json');}

    public function indexAction(){

        $form = new Form_Users();
        $form->submit->setLabel('Додати користувача');
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData))
            {
                $username = $form->getValue('username');
                $email = $form->getValue('email');
                $website = $form->getValue('website');
                $text = $form->getValue('text');
                $pages = new Model_DbTable_Users();
                $pages->addData( $username, $email, $website, $text );

                $this->_helper->redirector('index','table');
            } else {
                $form->populate($formData);
            }
        }
    }

    public function simpleAjaxAction(){

    }

    public function getAjaxDataAction(){
        $this->_helper->viewRenderer->setNoRender();
        echo "Дані не ajax";
    }

    public function getAjaxDataJsonAction(){
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);

        $name = $this->_getParam('userid');

        $n = $name;
        echo $n;
        if($name){
            $json_data = array('resString' => 'Привіт, ' . $name . ' !');
        }else{
            $json_data = array('resString' => 'Нічого немає !');
        }

        $result = new Model_DbTable_Users();
        $result = $result->getAjaxData($name);

            $users = $name;
           for($i = 0; $i<sizeof($result); $i++){

               $users .="</br> " . $result[$i]['username'] . " " . $result[$i]['website'];
           }
        //echo $users;
    }

    public function searchArticles( $data )
    {
       $this->_helper->viewRenderer->setNoRender();
        $this->_helper->getHelper("layout")->disableLayout();

        $users = '<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">';

        $users .= '<ul class="list-group">';

        for ( $i = 0; $i < sizeof ( 5 ); $i++ ) {
            $users .= '<li class="list-group-item">';

            $users .= ''
                . 33 .
                '<a href="'. 77 .'">Link</a>';

            $users .= '</li>';

        }

        $users .= '</ul>';
        $users .= '</div>';
        print $users;
    }
}