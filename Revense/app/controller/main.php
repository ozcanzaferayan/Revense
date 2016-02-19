<?php

require_once 'app/model/test.php';
//require_once 'app/model/user.php';

class MainController extends Controller
{
    function index($test2, $test3)
    {
        echo $test2 . '<br>' . $test3;
        
        $this->view->isLoggedIn = User::isLoggedIn();
//        $model = new TestModel;
        
//        $model->test();
        
        $this->view->load('index/index');
    }
    
    function index2()
    {
//        phpinfo();
        $this->view->load('index/index2');
    }
    
    function getItems($parameters)
    {
//        print_r($mainCategorySlug);
        
//        echo $mainCategorySlug . ' - ' . $subCategorySlug;
    }
}

?>
