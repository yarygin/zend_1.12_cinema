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

    public function placesAction()
    {
        $request = $this->getRequest();
        $session_id = $request->getParam('session_id');
        if(in_array($request->getMethod(), $request->getParam('allowed'))) {
            $tickets_res = new Application_Model_DbTable_Ticket();
            $tickets = $tickets_res->getAvailableTickets($session_id);
            $result = Zend_Json::encode($tickets);
            $this->response(200, $result);
        }
        else
        {
            $this->response(405, "Метод не поддерживается");
        }
    }


}

