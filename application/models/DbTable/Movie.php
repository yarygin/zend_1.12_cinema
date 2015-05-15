<?php

class Application_Model_DbTable_Movie extends Zend_Db_Table_Abstract
{

    protected $_name = 'movie';

    public function getMovieByTitle($title)
    {
        $row = $this->fetchRow('title = "' . $title . '"');
        if(!$row) {
            throw new Exception("Нет записи с title - $title");
        }
        return $row->toArray();
    }
}
