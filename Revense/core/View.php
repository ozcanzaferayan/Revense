<?php
//session_start();

class View {
    var $title = '';
    var $defaultLayout = 'main';
    
    function __construct() {
        $this->title = constant('SITE_TITLE');
        $this->defaultLayout = constant('DEFAULT_LAYOUT');
    }
    
    public function load($viewName, $layout = 'default')
    {
        if($layout == 'default')
            $layout = $this->defaultLayout;
        
        if($layout != null)
            require_once $_SERVER['DOCUMENT_ROOT'] . '/app/view/layout/' . $layout . '/header.php';
        
        require_once $_SERVER['DOCUMENT_ROOT'] . '/app/view/'.$viewName.'.php';
        
        if($layout != null)
            require_once $_SERVER['DOCUMENT_ROOT'] . '/app/view/layout/' . $layout . '/footer.php';
    }
}
?>
