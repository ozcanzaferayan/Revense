<?php

/**
 * Restful Service
 *
 * @author Zafer AYAN
 */
abstract class AbstractRest {

    public $_allow = array();
    public $_content_type = "application/json";
    public $_request = array();
    
    private $_method = "";
    private $_code = 200;

    /**
     * Constructor
     */
    public function __construct() {
        $this->inputs();
    }
    
    /**
     * Process related function with request
     */
    abstract function processApi();


    /**
     * Filters $_SERVER['REQUEST_METHOD'] data for possible attacks.
     * @return type filtered request method
     */
    public function getRequestMethod() {
        return filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_STRING);
    }

    /**
     * Filters $_POST array data for possible attacks.
     * @return type filtered post data
     */
    public function getPostRequest() {
        return filter_input_array(INPUT_POST);
    }

    /**
     * Filters $_GET array data for possible attacks.
     * @return type filtered get data
     */
    public function getGetRequest() {
        return filter_input_array(INPUT_GET);
    }
    
    /**
     * Filters $_REQUEST array data for possible attacks.
     * @return type filtered request data
     */
    public function getRequestFunctionHeader(){
        return filter_input_array(INPUT_REQUEST, 'reqFun');
    }

    /**
     * Handles Http Request methods such GET, POST, PUT etc.
     */
    private function inputs() {
        switch ($this->getRequestMethod()) {
            case 'GET':
                $this->_request = $this->clearInputs($this->getGetRequest());
                break;
            case 'POST':
                $this->_request = $this->clearInputs($this->getPostRequest());
                break;
            case 'PUT':
                parse_str(file_get_contents('php://input'), $this->_request);
                $this->_request = $this->clearInputs($this->_request);
                break;
            case 'DELETE':
            case 'HEAD':
            case 'OPTIONS':
            case 'TRACE':
            case 'PATCH':
            default:
                // 406: Not Acceptable
                $this->response('', 406);
                break;
        }
    }

    /**
     * Clear invalid characters from request data
     * @param type $data request data
     */
    private function clearInputs($data) {
        $cleanInput = array();
        // If data is an array, clear inner objects inputs recursively.
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $cleanInput[$key] = $this->clearInputs($value);
            }
        } else {
            // PHP 5.4: Always returns false
            if (get_magic_quotes_gpc()) {
                $data = trim(stripslashes($data));
            }
            $data = strip_tags($data);
            $cleanInput = trim($data);
        }
        return $cleanInput;
    }

    /**
     * Sets HTTP Status Code and Content Type
     */
    private function setHeaders() {
        http_response_code($this->_code);
        header("Content-Type:" . $this->_content_type);
    }
    
    /**
     * Returns response to client
     * @param type $data Response data
     * @param type $statusCode HTTP Status code
     */
    public function response($data, $statusCode) {
        $this->_code = ($statusCode) ? $statusCode : 200;
        $this->setHeaders();
        echo $data;
        exit();
    }
}
