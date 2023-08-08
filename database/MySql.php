<?php

    namespace Database;

    use \PDO;
    use \PDOException;

    class MySql {

        private static $host = "localhost";
        private static $port = 3306;
        private static $user = "root";
        private static $pass = "";
        private static $dbname = "";
        private static $charset = "utf8";
        private static $con = null;


        function __construct() {
            # update database connect from .env
            self::$host = $_ENV['MYSQL_HOST'];
            self::$port = intval($_ENV['MYSQL_PORT']);
            self::$user = $_ENV['MYSQL_USER'];
            self::$pass = $_ENV['MYSQL_PASS'];
            self::$dbname = $_ENV['MYSQL_NAME'];
        }
    

        public static function Connect() {
            if (self::$con){
                return self::$con;
            } else {
                try {
                    self::$con = new PDO("mysql:host=".self::$host.";charset=".self::$charset.";port=".self::$port.";dbname=".self::$dbname, self::$user, self::$pass);
                    self::$con -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    return self::$con;
                } catch (PDOException $e) {
                    echo "Connect failed: " . $e -> getMessage();
                    exit;
                }
            }
        }


    }

