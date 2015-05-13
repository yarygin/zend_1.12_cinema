<?php

$routes = Array(
    'cinema_info'=> new Zend_Controller_Router_Route(
        '/api/cinema/:cinema_name',
        array(
            'controller' => 'cinema',
            'action'     => 'info',
            'allowed'    =>  array('GET')
        ) 
    ),
    'cinema_schedule'=> new Zend_Controller_Router_Route(
        '/api/cinema/:cinema_name/schedule',
        array(
            'controller' => 'cinema',
            'action'     => 'schedule',
            'allowed'    =>  array('GET')
        ) 
    ),
    'movie_info'=> new Zend_Controller_Router_Route(
        '/api/movie/:movie_title',
        array(
            'controller' => 'movie',
            'action'     => 'info',
            'allowed'    =>  array('GET')
        ) 
    ),
    'movie_shcedule'=> new Zend_Controller_Router_Route(
        '/api/movie/:movie_title/schedule',
        array(
            'controller' => 'movie',
            'action'     => 'schedule',
            'allowed'    =>  array('GET')
        ) 
    ),
    'session_places'=> new Zend_Controller_Router_Route(
        '/api/session/:session_id/places',
        array(
            'controller' => 'session',
            'action'     => 'places',
            'allowed'    =>  array('GET')
        ) 
    ),
    'tickets_buy'=> new Zend_Controller_Router_Route(
        '/api/tickets/buy',
        array(
            'controller' => 'session',
            'action'     => 'buy',
            'allowed'    =>  array('POST')
        ) 
    ),
    'tickets_reject'=> new Zend_Controller_Router_Route(
        '/api/tickets/reject',
        array(
            'controller' => 'session',
            'action'     => 'reject',
            'allowed'    =>  array('POST')
        ) 
    ),
);
foreach ($routes as $name => $route) {
    $router->addRoute($name, $route);
}