<?php

class Bootstrap {

    function __construct() {
        $pg = isset($_GET['pg']) ? $_GET['pg'] : null;
        $pg = rtrim($pg, '/');
        $pg = explode('/', $pg);
        
        if(empty($pg[0]))
        {
            $defaultController = constant('DEFAULT_CONTROLLER');
            $defaultAction = constant('DEFAULT_ACTION');
            require_once 'app/controller/' . $defaultController . '.php';
            $controller = new $defaultController();
            $controller->$defaultAction();
            return FALSE;
        }   
        
        $file = 'controllers/' . $pg[0] . '.php';

        if (file_exists($file))
            require_once $file;
        
        $pg[0] = str_replace('-', '', $pg[0]);
        $controller = new $pg[0];

        if (isset($pg[4])) {
            $controller->{$pg[1]}(array($pg[2], $pg[3], $pg[4]));
        } else {
            if (isset($pg[3])) {
                $controller->{$pg[1]}(array($pg[2], $pg[3]));
            } else {
                if (isset($pg[2])) {
                    $controller->{$pg[1]}($pg[2]);
                } else {
                    if (isset($pg[1])) {
                        $controller->{$pg[1]}();
                    }
                }
            }
        }
    }

}

?>
