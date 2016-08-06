<?php

class Model_DbTable_GuestBook extends Zend_Db_Table_Abstract
{

    protected $_name = 'guestlist';

    public function getPage($id)
    {
        $id = (int)$id;
        $row = $this->fetchRow('id = ' . $id)->order('id DESC');
        if (!$row) {
            throw new Exception("Could not find row $id");
        }
        return $row->toArray();
    }

    public function addData($username, $email, $website, $text )
    {
        $browser_type = $this->getBrowser();
        $ip_address = $_SERVER["REMOTE_ADDR"];
        $data = array(
            'username' => $username,
            'email' => $email,
            'website'=> $website,
            'text'=> $text,
            'ip_address' => $ip_address,
            'browser_type' => $browser_type,
        );
        $this->insert($data);
    }


    public function updateData($id, $username , $email, $website,$text)
    {
        $data = array(
            'username' => $username,
            'email' => $email,
            'website' => $website,
            'text' => $text
        );
        $this->update($data, 'id = '. (int)$id);

    }

    public function deletePage($id)
    {
        $this->delete('id =' . (int)$id);
    }

    public function getData(){
        Zend_View_Helper_PaginationControl::setDefaultViewPartial('/pagination.phtml');
        $pages = new Application_Model_DbTable_Pages();

        $select = $pages->select()->order('id DESC');

        $result = $this->view->table = $pages->fetchAll($select)->toArray();
        return $result;

    }

    public function getSortData($row, $sortType){
        Zend_View_Helper_PaginationControl::setDefaultViewPartial('/pagination.phtml');
        $pages = new Application_Model_DbTable_Pages();

        $allowed = array("row");
        $key     = array_search($row,$allowed);
        $orderby = $allowed[$key];
        $order   = ($sortType == 'DESC') ? 'DESC' : 'ASC';

        $select = $pages->select()->order(''.$orderby.' '.$order.'');
        $result = $this->view->table = $pages->fetchAll($select)->toArray();
        return $result;
    }

    private function getBrowser()
    {
        $user_agent = $_SERVER["HTTP_USER_AGENT"];
        if (strpos($user_agent, "Firefox") !== false) $browser = "Firefox";
        elseif (strpos($user_agent, "Opera") !== false) $browser = "Opera";
        elseif (strpos($user_agent, "Chrome") !== false) $browser = "Chrome";
        elseif (strpos($user_agent, "MSIE") !== false) $browser = "Internet Explorer";
        elseif (strpos($user_agent, "Safari") !== false) $browser = "Safari";
        else $browser = "Невідомий браузер";
        return $browser;
    }

}