<?php

$routes = Array(
    'cinema_info'=> new Zend_Controller_Router_Route(
        '/api/cinema/:cinema_name',
        array(
            'controller' => 'cinema',
            'action'     => 'info'
        ) 
    ),
    'cinema_schedule'=> new Zend_Controller_Router_Route(
        '/api/cinema/:cinema_name/schedule',
        array(
            'controller' => 'cinema',
            'action'     => 'schedule'
        ) 
    ),
    'movie_info'=> new Zend_Controller_Router_Route(
        '/api/movie/:movie_title',
        array(
            'controller' => 'movie',
            'action'     => 'info'
        ) 
    ),
    'movie_shcedule'=> new Zend_Controller_Router_Route(
        '/api/movie/:movie_title/schedule',
        array(
            'controller' => 'movie',
            'action'     => 'schedule'
        ) 
    ),
    'session_places'=> new Zend_Controller_Router_Route(
        '/api/session/:session_id/places',
        array(
            'controller' => 'session',
            'action'     => 'places'
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