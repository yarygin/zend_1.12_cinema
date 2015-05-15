<?php

class MovieController extends Zend_Controller_Action
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

    public function scheduleAction()
    {
        $request = $this->getRequest();
        if(in_array($request->getMethod(), $request->getParam('allowed'))) {
            $movie_title = $this->clearString($request->getParam('movie_title'));
            if(isset($movie_title))
            {
                $movie_res = new Application_Model_DbTable_Session();
                $movie = $movie_res->getScheduleByMovieTitle($movie_title);
                $result = Zend_Json::encode($movie);
                $this->getResponse()->setBody($result);
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
            $movie_title = $this->clearString($request->getParam('movie_title'));
            if(isset($movie_title))
            {
                $movie_res = new Application_Model_DbTable_Movie();
                $movie = $movie_res->getMovieByTitle($movie_title);
                $result = Zend_Json::encode($movie);
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

