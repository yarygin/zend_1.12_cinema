<?php

class SessionController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
        $this->_helper->viewRenderer->setNoRender(true);
    }

    protected function response($status, $body)
    {
        $response = $this->getResponse();
        $response->setBody($body);
        $response->setHeader('Content-Type', 'application/json; charset=UTF-8', true);
        $response->setHttpResponseCode($status);
    }

    private function clearString($str)
    {
        return strip_tags(htmlspecialchars(mysql_escape_string($str)));
    }

    public function placesAction()
    {
        $request = $this->getRequest();
        if(in_array($request->getMethod(), $request->getParam('allowed'))) {
            $session_id = $request->getParam('session_id');
            if(isset($session_id))
            {
                $tickets_res = new Application_Model_DbTable_Ticket();
                $tickets = $tickets_res->getAvailableTickets($session_id);
                $result = Zend_Json::encode($tickets);
                $this->response(200, $result);
            }
            else 
            {
                $this->response(400, "Неверные параметры");
            }
        }
        else
        {
            $this->response(405, "Метод не поддерживается");
        }
    }

    public function buyAction()
    {
        $request = $this->getRequest();
        $session_id = (int)$request->getPost('session_id', null);
        $row_number = (int)$request->getPost('row_number', null);
        $place_number = (int)$request->getPost('place_number', null);
        if(in_array($request->getMethod(), $request->getParam('allowed'))) {    
            $tickets_res = new Application_Model_DbTable_Ticket();
            if(!(is_null($session_id) && is_null($row_number) && is_null($place_number)))
            {
                if($tickets_res->isAvailable($session_id, $row_number, $place_number))
                {
                    $unique_code = $tickets_res->buyTicket($session_id, $row_number, $place_number);
                    $result = Zend_Json::encode($unique_code);
                    $this->response(200, $result);
                }
                else
                {
                    $this->response(400, "Билеты недоступны");
                }
            }
            else
            {
                $this->response(400, "Неверные параметры");
            }
        }
        else
        {
            $this->response(405, "Метод не поддерживается");
        }
    }

    public function rejectAction()
    {
        $request = $this->getRequest();
        if(in_array($request->getMethod(), $request->getParam('allowed'))) {
            $unique_code = $this->clearString($request->getPost('unique_code', null));
            if(!is_null($unique_code))
            {
                $tickets_res = new Application_Model_DbTable_Ticket();
                if($tickets_res->getTicketByCode($unique_code))
                {
                    $reject = $tickets_res->rejectTicket($unique_code);
                    $result = Zend_Json::encode($reject);
                    $this->response(200, $result);
                }
                else
                {
                    $this->response(400, "Билеты недоступны");
                }
            }
            else
            {
                $this->response(400, "Неверные параметры");
            }
            
        }
        else
        {
            $this->response(405, "Метод не поддерживается");
        }
    }
}

