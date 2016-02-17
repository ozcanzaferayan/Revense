<?php

class Main extends Controller
{
    function index($mainCategorySlug)
    {
        echo $mainCategorySlug;
        
        $this->view->load('index/index');
    }
    
    function getItems($parameters)
    {
        print_r($mainCategorySlug);
        
//        echo $mainCategorySlug . ' - ' . $subCategorySlug;
    }
}

?>
