<?php

/**
 * Created by PhpStorm.
 * User: oleh
 * Date: 04.08.16
 * Time: 14:07
 */
class PublicationController extends Zend_Controller_Action
{

    public function init()
    {
        $this->_helper->getHelper('AjaxContext')->initContext('json');

        $this->_helper->contextSwitch()
            ->addActionContext('getJsonResponse', array('json'))
            ->initContext();
    }

    /**
     * вивід усіх записів
     * вивід уподобаних записів(якщо такі є)
     */
    public function indexAction()
    {
        $result = new Model_DbTable_Publication();
        $publicationsList = $result->getData(5,0);
        $this->view->publicationsList = $publicationsList;

        $cookieVal = $_COOKIE['selectedItems'];
        if( !empty($cookieVal)){
            $favoriteList = $result->getFavoriteData($cookieVal);
            $this->view->favoriteList = $favoriteList;
        }

    }

    /**
     * Функція підвантажує додаткові записи
     */
    public function showadditionallydataAction(){

        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $row = $this->_getParam('startFrom') ;
        $result = new Model_DbTable_Publication();
        $result = $result->getData(3, $row);

        echo json_encode($result->toArray());

    }

    /**
     * пошук у записах
     */
    public function searchAction(){
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);

        $searchWord = $this->_getParam('search');

        $result = new Model_DbTable_Publication();
        $result = $result->searchData($searchWord);

        echo json_encode($result->toArray());

    }
}