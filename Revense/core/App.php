<?php

class Application {
    function __construct() {
        try
        {
            global $routeCollection;
            
            $page = isset($_GET['pg']) ? $_GET['pg'] : null;
            $pg = rtrim($page, '/');
            $pg = explode('/', $pg);
            $routeMatch = FALSE;
            
            foreach($routeCollection->routes as $route)
            {
                if(ltrim(rtrim($page, '/'), '/') == ltrim(rtrim($route->pattern, '/'), '/') 
                   || preg_match('/' . preg_replace('/\//i', '\\/', rtrim($page, '/')) . '\/{.+}/i', $route->pattern) == 1)
                {
                    $parameters = array();
                    
                    if(preg_match('/{.+}/i', $route->pattern) == 1)
                    {
                        $mismatchKeyFound = FALSE;
                        preg_match_all('/{.+?}/i', $route->pattern, $matches);
                        
                        foreach($matches[0] as $match)
                        {
                            $key = rtrim(ltrim($match, '{'), '}');
                            
                            if($route->method === 'POST')
                            {
                                if(!isset($_POST[$key])){ $mismatchKeyFound = TRUE; break; }
                                
                                $parameters[] = $_POST[$key];
                            }
                            else if($route->method === 'GET')
                            {
                                if(!isset($_GET[$key])){ $mismatchKeyFound = TRUE; break; }
                                
                                $parameters[] = $_GET[$key];
                            }
                            else if($route->method === 'PUT')
                            {
                                parse_str(file_get_contents("php://input"),$putVars);
                                
                                if(!isset($putVars[$key])){ $mismatchKeyFound = TRUE; break; }
                                
                                $parameters[] = $putVars[$key];
                            }
                            else if($route->method === 'DELETE')
                            {
                                parse_str(file_get_contents("php://input"),$deleteVars);
                                
                                if(!isset($deleteVars[$key])){ $mismatchKeyFound = TRUE; break; }
                                
                                $parameters[] = $deleteVars[$key];
                            }
                        }
                        
                        if($_SERVER['REQUEST_METHOD'] != $route->method || $mismatchKeyFound)
                            continue;
                        
                        if(isset($route->action['Controller']))
                            $this->loadControllerAction($route->action['Controller'], $parameters);
                        else if(isset($route->action['View']))
                            $this->loadView($route);
                        
                        $routeMatch = TRUE;
                        break;
                    }
                    else
                    {
                        if($_SERVER['REQUEST_METHOD'] != $route->method)
                            continue;
                        
                        if(isset($route->action['Controller']))
                            $this->loadControllerAction($route->action['Controller'], $parameters);
                        else if(isset($route->action['View']))
                            $this->loadView($route);
                        
                        $routeMatch = TRUE;
                        break;
                    }
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
