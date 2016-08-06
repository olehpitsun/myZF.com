<?php

/**
 * Created by PhpStorm.
 * User: oleh
 * Date: 04.08.16
 * Time: 14:15
 */
class Model_DbTable_Publication extends Zend_Db_Table_Abstract
{

    // таблиця БД
    protected $_name = 'publications';

    public function getData($count, $offset){

        $select = $this->select()
            ->from($this)
            ->limit($count , $offset);

        $row = $this->fetchAll($select);
        return $row;
    }

    public function getFavoriteData($ids){
        $select = $this->select()
            ->from($this)
            ->where('id IN ('.$ids.')');

        $result = $this->fetchAll($select)->toArray();
        return $result;
    }

    public function getSortData($row, $sortType){

        $select = $this->select()->order(''.$row.' '.$sortType.'');
        $result = $this->view->publication = $this->fetchAll($select)->toArray();
        return $result;

    }

    public function searchData($word){
        $select = $this->select()
            ->from($this)
            ->where('title LIKE ?', '%' . $word . '%');

        $row = $this->fetchAll($select);
        return $row;
    }
}