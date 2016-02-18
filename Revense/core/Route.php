<?php

class Route
{
    var $name;
    var $pattern;
    var $action;
    var $method;
    
    function __construct($name_, $pattern_, $action_, $method_ = 'GET'){
        $this->name = $name_;
        $this->pattern = $pattern_;
        $this->action = $action_;
        $this->method = $method_;
    }
}

?>