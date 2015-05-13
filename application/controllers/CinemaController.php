<?php

class CinemaController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
        $this->_helper->viewRenderer->setNoRender(true);
    }

    protected function response($status, $body)
    {
        $response = $this->getResponse();
        $response->setHeader('Content-Type', 'application/json; charset=UTF-8', true);
        $response->setBody($body);
        $response->setHttpResponseCode($status);
    }

    public function scheduleAction()
    {
        $request = $this->getRequest();
        $cinema_name = $request->getParam('cinema_name');
        $hall = $request->getParam('hall');
        if(in_array($request->getMethod(), $request->getParam('allowed'))) {
            $cinemas = new Application_Model_DbTable_Session();
            $cinema = $cinemas->getScheduleByCinemaName($cinema_name, $hall);
            $result = Zend_Json::encode($cinema, JSON_UNESCAPED_UNICODE);
            $this->response(200, $result);
        }
        else
        {
            $this->response(405, "Метод не поддерживается");
        }
    }

    public function infoAction()
    {
        $request = $this->getRequest();
        $cinema_name = $request->getParam('cinema_name');
        if(in_array($request->getMethod(), $request->getParam('allowed'))) {
            $cinemas = new Application_Model_DbTable_Cinema();
            $cinema = $cinemas->getCinemaByName($cinema_name);
            $result = Zend_Json::encode($cinema);
            $this->response(200, $result);
        }
        else
        {
            $this->response(405, "Метод не поддерживается");
        }
    }

}
