<?php

class Application {
    function __construct() {
        try
        {
            $pg = isset($_GET['pg']) ? $_GET['pg'] : null;
            $pg = rtrim($pg, '/');
            $pg = explode('/', $pg);

            print_r($pg);
            
            if(empty($pg[0]))
            {
                $defaultController = constant('DEFAULT_CONTROLLER');
                $defaultAction = constant('DEFAULT_ACTION');
                require_once 'app/controller/' . $defaultController . '.php';
                $controller = new $defaultController();
                $controller->$defaultAction();
                return FALSE;
            }   

            $file = 'app/controller/' . $pg[0] . '.php';

            if (file_exists($file))
                require_once $file;

            $pg[0] = str_replace('-', '', $pg[0]);
            
            if(!class_exists($pg[0]))
            {
                Logger::error('App.php - Given class not found: ' . $pg[0]);
                return;
            }
            
            $controller = new $pg[0];

            if (isset($pg[4]))
                $controller->{$pg[1]}(array($pg[2], $pg[3], $pg[4]));
            else
            {
                if (isset($pg[3]))
                {
                    Logger::info('TEST');
                    $controller->{$pg[1]}(array($pg[2], $pg[3]));
                }
                else
                {
                    if (isset($pg[2]))
                        $controller->{$pg[1]}($pg[2]);
                    else
                    {
                        if (isset($pg[1]))
                            $controller->{$pg[1]}();
                        else
                            $controller->index();
                    }
                }
            }
        }
        catch(Exception $ex)
        {
            
        }
    }

}

?>
