<?php

require_once 'app/model/test.php';

class Main extends Controller
{
    function index($test2, $test3)
    {
        echo $test2 . '<br>' . $test3;
//        $model = new TestModel;
        
//        $model->test();
        
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
