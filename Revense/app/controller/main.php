<?php

class Main extends Controller
{
    function index($test)
    {
        echo $test;
        
        $this->view->load('index/index');
    }
    
    function index2()
    {
        $this->view->load('index/index2');
    }
    
    function getItems($parameters)
    {
//        print_r($mainCategorySlug);
        
//        echo $mainCategorySlug . ' - ' . $subCategorySlug;
    }
}

?>
