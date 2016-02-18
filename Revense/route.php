<?php

$routeCollection = new RouteCollection(array(
    new Route('test1', '/admin/category/add/{test2}', array('Controller' => 'main')),
    new Route('test2', '/admin/category/edit', array('Controller' => 'main@index2')),
    new Route('test3', '/admin/category/update', array('View' => 'index/index2', 'Layout' => 'admin'))
));

?>