<?php

class TableController extends Zend_Controller_Action
{

    public function init(){/* Initialize action controller here */}

    public function indexAction()
    {
        $num = 25;
        $page = $this->_getParam('page');

        $result = new Model_DbTable_Table();
        if($this->_getParam('row'))
        {
            $row = $this->_getParam('row');
            $type = $this->_getParam('type');

            $result = $result-> getSortData($row,$type);
        } else
        {
            $result = $result->getData();
        }
        $paginator = new Zend_Paginator(new Zend_Paginator_Adapter_Array($result));
        $paginator->setItemCountPerPage($num);
        $paginator->setCurrentPageNumber($page);
        $paginator->setView($this->view);
        $this->view->paginator = $paginator;
    }

    public function editAction()
    {
        $form = new Form_GuestBook();
        $form->submit->setLabel('Save');
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $id = (int)$this->_getParam('id');
                $username = $form->getValue('username');
                $email = $form->getValue('email');
                $website = $form->getValue('website');
                $text = $form->getValue('text');
                $data = new Model_DbTable_Table();
                $data->updateData($id, $username , $email, $website,$text);

                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        } else {
            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $data = new Model_DbTable_Table();
                $form->populate($data->getInfoByid($id));
            }
        }
    }

    public function deleteAction()
    {
        if ($this->getRequest()->isPost()) {
            $del = $this->getRequest()->getPost('del');
            if ($del == 'Yes') {
                $id = $this->getRequest()->getPost('id');
                $data = new Model_DbTable_Table();
                $data->deleteData($id);
            }
            $this->_helper->redirector('index','table');
        } else {
            $id = $this->_getParam('id', 0);
            $data = new Model_DbTable_Table();
            $this->view->data = $data->getInfoByid($id);
        }
    }
}







