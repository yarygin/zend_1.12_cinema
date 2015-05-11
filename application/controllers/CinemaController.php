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
        if($request->isPost()) {
            $this->getResponse()->setBody("POST".$cinema_name.$hall);
        }
        else {
                // Создаём объект нашей модели
            $cinemas = new Application_Model_DbTable_Cinema();
            $cinema = $cinemas->getCinemaByName($cinema_name);
            // $result = json_encode($all_movies);
            $result = Zend_Json::encode($cinema);
            // $this->getResponse()->setBody("GET".$cinema_name.$hall.print_r($all_movies, true));
            $this->getResponse()->setBody($result);
        }
        $this->getResponse()->setHttpResponseCode(200);
    }

}
