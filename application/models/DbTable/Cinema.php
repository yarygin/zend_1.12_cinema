<?php

class Application_Model_DbTable_Cinema extends Zend_Db_Table_Abstract
{

    protected $_name = 'cinema';

    public function getCinemaByName($name)
    {
        $name = $name;
        $row = $this->fetchRow('name = "' . $name . '"');
        if(!$row) {
            throw new Exception("Нет записи с name - $name");
        }
        return $row->toArray();
    }



}

