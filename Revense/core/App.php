<?php

class Application {
    function __construct() {
        try
        {
            global $routeCollection;
            
            $pg = isset($_GET['pg']) ? $_GET['pg'] : null;
            $pg = rtrim($pg, '/');
            $pg = explode('/', $pg);
            
            foreach($routeCollection->routes as $route)
            {
                $pattern = ltrim(rtrim($route->pattern, '/'), '/');
                $pattern = explode('/', $pattern);
                $routeDifference = array_diff($pattern, $pg);
                
                if(count($routeDifference) === 0 || (strpos(array_values($routeDifference)[0], '}') !== false)) // match
                {
                    if($_SERVER['REQUEST_METHOD'] != $route->method){
                        header("HTTP/1.0 404 Not Found");
                        die();
                    }
                    
                    if(isset($route->action['Controller'])){
                        $temp = explode('@', $route->action['Controller']);
                        $file = 'app/controller/' . $temp[0] . '.php';
                        
                        if (file_exists($file))
                            require_once $file;
                        
                        $controller = new $temp[0];
                        $parameterKey = '';
                        $parameterValue = '';
                        
                        if(count($routeDifference) === 1)
                        {
                            if(strpos(array_values($routeDifference)[0], '}') !== false){
                                $parameterKey = ltrim(rtrim(array_values($routeDifference)[0], '}'), '{');

                                if($route->method === 'POST')
                                    $parameterValue = $_POST[$parameterKey];
                                else
                                    $parameterValue = $_GET[$parameterKey];
                            }
                        }
                        
                        if(isset($temp[1]))
                            $controller->{$temp[1]}($parameterValue);
                        else
                            $controller->index($parameterValue);
                    }
                    else if(isset($route->action['View'])){
                        $layout = 'default';
                        
                        if(isset($route->action['Layout']))
                            $layout = $route->action['Layout'];
                        
                        $view = new View;
                        $view->load($route->action['View'], $layout);
                    }
                    
                    break;
                }
            }
        }
        catch(Exception $ex)
        {
            
        }
    }
}

?>
