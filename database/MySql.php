<?php

    namespace Database;

    use \PDO;
    use \PDOException;

    class MySql {

        private $host = "localhost";
        private $port = 3306;
        private $user = "root";
        private $pass = "";
        private $dbname = "";
        private $charset = "utf8";
        private $con = null;


        public function __construct() {
            # update database connect from .env
            $this -> host = $_ENV['MYSQL_HOST'];
            $this -> port = intval($_ENV['MYSQL_PORT']);
            $this -> user = $_ENV['MYSQL_USER'];
            $this -> pass = $_ENV['MYSQL_PASS'];
            $this -> dbname = $_ENV['MYSQL_NAME'];
        }
    

        public function connect() {
            if ($this -> con){
                return $this -> con;
            } else {
                try {
                    $this -> con = new PDO("mysql:host=" . $this -> host . ";charset=" . $this -> charset . ";port=" . $this -> port . ";dbname=" . $this -> dbname, $this -> user, $this -> pass);
                    $this -> con -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    return $this -> con;
                } catch (PDOException $e) {
                    echo "Connect failed: " . $e -> getMessage();
                    exit;
                }
            }
        }
    }

