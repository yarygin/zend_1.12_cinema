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

    public function scheduleAction()
    {
        $request = $this->getRequest();
        $movie_title = $request->getParam('movie_title');
        if($request->isGet()) {
            $movies = new Application_Model_DbTable_Sessions();
            $movie = $movies->getScheduleByMovieTitle($movie_title);
            $result = Zend_Json::encode($movie);
            $this->getResponse()->setBody($result);
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
        $movie_title = $request->getParam('movie_title');
        if($request->isGet()) {
            $movies = new Application_Model_DbTable_Movie();
            $movie = $movies->getMovieByTitle($movie_title);
            $result = Zend_Json::encode($movie);
            $this->response(200, $result);
        }
        else
        {
            $this->response(405, "Метод не поддерживается");
        }
    }

}

