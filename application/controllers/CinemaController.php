<?php

class CinemaController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
        $this->_helper->viewRenderer->setNoRender(true);
    }

    public function scheduleAction()
    {
        $request = $this->getRequest();
        $cinema_name = $request->getParam('cinema_name');
        $hall = $request->getParam('hall');
        if($request->isGet()) {
            $cinemas = new Application_Model_DbTable_Sessions();
            $cinema = $cinemas->getScheduleByCinemaName($cinema_name, $hall);
            $result = Zend_Json::encode($cinema);
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
        if($request->isGet()) {
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

    protected function response($status, $body)
    {
        $this->getResponse()->setBody($body);
        $this->getResponse()->setHttpResponseCode($status);
    }

}
