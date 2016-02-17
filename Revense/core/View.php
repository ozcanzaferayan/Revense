<?php
session_start();

class View {
    var $title = '';
    
    function __construct() {
        $this->title = constant('SITE_TITLE');
    }
    
    public function load($viewName, $useTemplate = TRUE)
    {
        if($useTemplate)
            require_once $_SERVER['DOCUMENT_ROOT'] . '/app/view/header.php';
        
        require_once $_SERVER['DOCUMENT_ROOT'] . '/app/view/'.$viewName.'.php';
        
        if($useTemplate)
            require_once $_SERVER['DOCUMENT_ROOT'] . '/app/view/footer.php';
    }

}
?>
