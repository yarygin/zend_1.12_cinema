<?php

class CinemaController extends Zend_Controller_Action
{

    public function init()
    {
        $this->_helper->viewRenderer->setNoRender(true);
    }

    protected function response($status, $body)
    {
        $response = $this->getResponse();
        $response->setHeader('Content-Type', 'application/json; charset=UTF-8', true);
        $response->setBody($body);
        $response->setHttpResponseCode($status);
    }

    private function clearString($str)
    {
        return strip_tags(htmlspecialchars(mysql_escape_string($str)));
    }

    public function scheduleAction()
    {
        $request = $this->getRequest();
        if(in_array($request->getMethod(), $request->getParam('allowed'))) {
            $cinema_name = $this->clearString($request->getParam('cinema_name'));
            $hall = $this->clearString($request->getParam('hall'));
            if(isset($cinema_name))
            {
                $cinema_res = new Application_Model_DbTable_Session();
                $cinema = $cinema_res->getScheduleByCinemaName($cinema_name, $hall);
                $result = Zend_Json::encode($cinema, JSON_UNESCAPED_UNICODE);
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

    public function infoAction()
    {
        $request = $this->getRequest();
        if(in_array($request->getMethod(), $request->getParam('allowed'))) {
            $cinema_name = $this->clearString($request->getParam('cinema_name'));
            if(isset($cinema_name))
            {
                $cinema_res = new Application_Model_DbTable_Cinema();
                $cinema = $cinema_res->getCinemaByName($cinema_name);
                $result = Zend_Json::encode($cinema);
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

}
