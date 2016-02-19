<?php

class Application {
    function __construct() {
        try
        {
            global $routeCollection;
            
            $page = (isset($_GET['pg']) ? $_GET['pg'] : '');
            $pg = rtrim($page, '/');
            $pg = explode('/', $pg);
            $routeMatch = FALSE;
            
            if(strlen($page) === 0) // load default controller
            {
                $defaultController = constant('DEFAULT_CONTROLLER');
                $defaultAction = constant('DEFAULT_ACTION');
                
                $file = 'app/controller/' . $defaultController . '.php';

                if (file_exists($file))
                    require_once $file;
                
                $controller = new $defaultController;
                call_user_func_array(array($controller, $defaultAction), array());
                return;
            }
            
            foreach($routeCollection->routes as $route)
            {
                $temp1 = preg_replace('/{.+?}/i', '(.+)', ltrim(rtrim($route->pattern, '/'), '/'));
                $temp2 = preg_replace('/\//i', '\\/', $temp1);
                
                if(preg_match_all('/' . $temp2 . '$/i', ltrim(rtrim($page, '/'), '/')))
                {
                    if($_SERVER['REQUEST_METHOD'] != $route->method)
                        continue;
                    
                    $parameters = array();
                    $counter = 0;
                    preg_match_all('/' . $temp2 . '$/i', ltrim(rtrim($page, '/'), '/'), $matches);
                    
                    foreach($matches as $match)
                    {
                        if(++$counter == 1)
                            continue;
                        
                        $parameters[] = $match[0];  
                    }
                                      
                    if(isset($route->action['Controller']))
                        $this->loadControllerAction($route->action['Controller'], $parameters);
                    else if(isset($route->action['View']))
                        $this->loadView($route);
                    
                    $routeMatch = TRUE;
                    break;
                }
            }
            
            if(!$routeMatch){
                header("HTTP/1.0 404 Not Found");
                die();
            }
        }
        catch(Exception $ex)
        {
            
        }
    }
    
    function loadControllerAction($routeActionValue, $parameters){
        $controllerAndAction = explode('@', $routeActionValue);
        $file = 'app/controller/' . $controllerAndAction[0] . '.php';

        if (file_exists($file))
            require_once $file;

        $controller = new $controllerAndAction[0];

        if(isset($controllerAndAction[1]))
            call_user_func_array(array($controller, $controllerAndAction[1]), $parameters);
        else
            call_user_func_array(array($controller, 'index'), $parameters);
    }
    
    function loadView($route){
        $layout = 'default';

        if(isset($route->action['Layout']))
            $layout = $route->action['Layout'];

        $view = new View;
        $view->load($route->action['View'], $layout);
    }
}

?>
