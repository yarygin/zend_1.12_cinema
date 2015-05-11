<?php

$routes = Array(
    'cinema_schedule'=> new Zend_Controller_Router_Route(
        '/api/cinema/:cinema_name/schedule',
        array(
            'controller' => 'cinema',
            'action'     => 'schedule'
        ) 
    ),
    'movie_shcedule'=> new Zend_Controller_Router_Route(
        '/api/movie/:movie_name/schedule',
        array(
            'controller' => 'cinema',
            'action'     => 'schedule'
        ) 
    ),
    'sessions'=> new Zend_Controller_Router_Route(
        '/api/session/:session_id/places',
        array(
            'controller' => 'cinema',
            'action'     => 'schedule'
        ) 
    ),
    'tickets_buy'=> new Zend_Controller_Router_Route(
        '/api/tickets/buy',
        array(
            'controller' => 'cinema',
            'action'     => 'schedule'
        ) 
    ),
);
foreach ($routes as $name => $route) {
    $router->addRoute($name, $route);
}