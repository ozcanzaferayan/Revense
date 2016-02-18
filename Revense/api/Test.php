<?php

/**
 * Description of Test
 *
 * @author Zafer AYAN
 */
require_once './AbstractRest.php';

class Test extends AbstractRest {

    private function categories() {
        // If method is not GET, return Not Acceptable
        if ($this->getRequestMethod() != "GET") {
            $this->response('', 406);
        } else {
            
            $categories[] = new Category('lumia 630', 'cep telefonları');            
            $categories[] = new Category('samsung s6', 'cep telefonları');
            $this->response(json_encode($categories), 200);
        }
    }

    public function processApi() {
        $requestedFunc = strtolower(trim(str_replace('/', '', $this->getRequestFunctionHeader())));
        echo $requestedFunc;
        if ((int) method_exists($this, $requestedFunc)) {
            $this->$requestedFunc();
        } else {
            $this->response('', 404);
        }
    }

}

class Category {
    public function __construct($name, $description) {
        $this->name = $name;
        $this->description = $description;
    }
    public $name;
    public $description;

}
$api = new Test;
$api->processApi();