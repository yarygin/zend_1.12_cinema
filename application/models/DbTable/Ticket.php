<?php

class Application_Model_DbTable_Ticket extends Zend_Db_Table_Abstract
{

    protected $_name = 'ticket';

    public function getTickets($id_session)
    {
        $select = $this->select()
                     ->from(array('t' => 'ticket'))
                     ->join(array('h' => 'hall_rows'),
                            't.id_row = h.id')
                     ->where('t.id_session = ?', $id_session );

        $select->setIntegrityCheck(false);
        return $this->fetchAll($select);
    }

    public function getAllPlaces($id_hall)
    {
        $select = $this->select()
                     ->from(array('p' => 'place'))
                     ->where('p.id_hall = ?', $id_hall);

        $select->setIntegrityCheck(false);
        $result = $this->fetchAll($select);
        return $result;
    }

    public function getAvailableTickets($id_session) {

        // SELECT p.* FROM place as p
        // INNER JOIN `session` as s on p.id_hall = s.id_hall
        // WHERE s.id = 12 AND p.id NOT IN (
        //     SELECT p.id FROM ticket as t 
        //     INNER JOIN `session` as s on s.id = t.id_session
        //     INNER JOIN place as p on p.row_number = t.row_number AND p.place_number = t.place_number AND s.id_hall = p.id_hall
        //     WHERE s.id = 12);
        
        $session_res = new Application_Model_DbTable_Session();
        $session = $session_res->getSession($id_session);

        $session_tickets = $this->select()
                     ->from(array('t' => 'ticket'), 
                            array())
                     ->join(array('s' => 'session'),
                            's.id = t.id_session',array())
                     ->join(array('p' => 'place'),
                            'p.row_number = t.row_number AND p.place_number = t.place_number AND s.id_hall = p.id_hall',
                            array('p.id'))
                     ->where('s.id = ?', $id_session )
                     ->setIntegrityCheck(false);

        // TODO: Отладить запрос    
        $select = $this->select()
                        ->from(array('p' => 'place'))
                        ->join(array('s' => 'session'),
                            'p.id_hall = s.id_hall', array())
                        ->where('s.id = ?', $id_session )
                        ->where('p.id NOT IN (?)',new Zend_Db_Expr($session_tickets) )
                        ->setIntegrityCheck(false);

        return $this->fetchAll($select);
    }

}

