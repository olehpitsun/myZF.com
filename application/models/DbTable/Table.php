<?php

class Model_DbTable_Table extends Zend_Db_Table_Abstract
{
    // таблиця БД
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

    public  function getInfoByid($id)
    {
        $$id = (int)$id;
        $row = $this->fetchRow('id = ' . $id);
        if (!$row) {
            throw new Exception("Could not find row $id");
        }
        return $row->toArray();

    }

    public function deleteData($id)
    {
        $this->delete('id =' . $id);
    }

    public function deletePage($id)
    {
        $this->delete('id =' . (int)$id);
    }

    public function getData()
    {
        Zend_View_Helper_PaginationControl::setDefaultViewPartial('/pagination.phtml');
        $select = $this->select()->order(' id DESC');
        $result = $this->fetchAll($select)->toArray();
        return $result;
    }

    public function getSortData($row, $sortType){

        Zend_View_Helper_PaginationControl::setDefaultViewPartial('/pagination.phtml');
        $select = $this->select()->order(''.$row.' '.$sortType.'');
        $result = $this->fetchAll($select)->toArray();
        return $result;
    }
}
