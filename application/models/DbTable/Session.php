<?php

class Application_Model_DbTable_Session extends Zend_Db_Table_Abstract
{

    protected $_name = 'session';

    public function getSession($id) {
        $row = $this->fetchRow('id = "' . $id . '"');
        if(!$row) {
            throw new Exception("Нет записи с id - $id");
        }
        return $row->toArray();
    }

    public function getScheduleByCinemaName($name, $hall = Null) {
        // Select `session`.`start`, hall.id_cinema, `session`.id_hall, `session`.id_movie, cinema.`name`, hall.title, movie.title from `session` 
        // inner join hall on `session`.id_hall = hall.id
        // inner join cinema on hall.id_cinema = cinema.id
        // inner join movie on `session`.id_movie = movie.id
        // where cinema.name = ":cinema_name"
        $select = $this->select()
                     ->from(array('s' => 'session'),
                            array('start', 'id_hall', 'id_movie'))
                     ->join(array('h' => 'hall'),
                            's.id_hall = h.id', array('id_cinema', 'h.title'))
                     ->join(array('c' => 'cinema'),
                            'c.id = h.id_cinema', array())
                     // раскомментить чтобы убрать старые
                     // ->where('s.start >= NOW()')
                     ->where('c.name = ?', $name );
        if(!is_null($hall)) {
            $select->where('h.title = ?', $hall);
        }
        $select->setIntegrityCheck(false);
        return $this->fetchAll($select);

    }

    public function getScheduleByMovieTitle($title) {
        // Select `session`.`start`, hall.id_cinema, `session`.id_hall, `session`.id_movie, hall.title, movie.title from `session` 
        // inner join hall on `session`.id_hall = hall.id
        // inner join movie on `session`.id_movie = movie.id
        // where movie.title = ":movie_title"
        $select = $this->select()
                     ->from(array('s' => 'session'),
                            array('start', 'id_hall', 'id_movie'))
                     ->join(array('h' => 'hall'),
                            's.id_hall = h.id', array('id_cinema', 'title'))
                     ->join(array('m' => 'movie'),
                            'm.id = s.id_movie', array())
                     // раскомментить чтобы убрать старые
                     // ->where('s.start >= NOW()')
                     ->where('m.title = ?', $title );

        $select->setIntegrityCheck(false);
        return $this->fetchAll($select);
    }
}

