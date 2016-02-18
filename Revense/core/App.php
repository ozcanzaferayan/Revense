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
                $routeDifference = array_diff($pg, $pattern);
                $routeDifference2 = array_diff($pattern, $pg);
                
//                print_r($routeDifference);
//                print '---------------------';
//                print_r($routeDifference2);
                
                if(count($routeDifference) === 0 && count($routeDifference2) === 0 
                   || (count($routeDifference2) > 0 && strpos(array_values($routeDifference2)[0], '}') !== false)) // match
                {
                    print_r($route);
                    
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
                        $parameters = array();
                        
                        foreach($routeDifference as $parameterKey)
                        {
                            $key = ltrim(rtrim($parameterKey, '}'), '{');
                            
                            if($route->method === 'POST')
                            {
                                if(!isset($_POST[$key])){
                                    header("HTTP/1.0 404 Not Found");
                                    die();
                                }
                                
                                $parameters[] = $_POST[$key];
                            }
                            else if($route->method === 'GET')
                            {
                                if(!isset($_GET[$key])){
                                    header("HTTP/1.0 404 Not Found");
                                    die();
                                }
                                
                                $parameters[] = $_GET[$key];
                            }
                        }
                        
                        if(isset($temp[1]))
                            call_user_func_array(array($controller, $temp[1]), $parameters);
                        else
                            call_user_func_array(array($controller, 'index'), $parameters);
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
