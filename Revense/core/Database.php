<?php

class Database
{
        static private $db;

        var $host   = '';
        var $user   = '';
        var $pass   = '';
        var $dbname = '';


        function __construct()
        {
            $this->host = constant('DB_HOST');
            $this->user = constant('DB_USER');
            $this->pass = constant('DB_PASSWORD');
            $this->dbname = constant('DB_NAME');
            
            try
            {
                self::$db = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->pass); 
                self::$db->exec("set names utf8");
                self::$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                self::$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
            }  
            catch(PDOException $e)
            {
                require_once('error_pages/technical_problem.php');
                die('Database Error: '. $e->getMessage());  
            }

            return self::$db;
        }
        public function prepare($statement, $driver_options=false) {
            if(!$driver_options) $driver_options=array();
            return self::$db->prepare($statement, $driver_options);
        }

        public function q($query)
        {
            return self::$db->query($query);
        }

        public function frow($query)
        {
            return $query->fetch(PDO::FETCH_ASSOC);
        }

        public function fassoc($query)
        {
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        public function numrows($query)
        {
            return $query->rowCount();
        }

        public function quote ($input, $parameter_type=0) {
            return self::$db->quote($input, $parameter_type);
        }
}
?>
