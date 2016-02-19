<?php

$routeCollection = new RouteCollection(array(
    new Route('test1', '/admin/category/add/{test2}/comments', array('Controller' => 'MainController@index2')),
    new Route('test1', '/admin/category/add/{test2}/{test3}', array('Controller' => 'MainController')),
    new Route('test1', '/admin/category/add/', array('Controller' => 'MainController@index2')), // default GET
    new Route('test2', '/admin/category/edit', array('Controller' => 'MainController@index2'), 'POST'),
    new Route('test3', '/admin/category/update', array('View' => 'index/index2', 'Layout' => 'admin'))
));

?>