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


        public function __construct() {
            # code...
        }
    

        public static function Connect() {
            // Create Connection
            try {
                self::$con = new PDO("mysql:host=".self::$host.";charset=".self::$charset.";port=".self::$port.";dbname=".self::$dbname, self::$user, self::$pass);
                self::$con -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "Connect failed: " . $e -> getMessage();
                exit;
            }
            return self::$con;
        }


        public static function ImagesTable($img_id) { // get users table
            $sql = "SELECT * FROM `myimgstable` WHERE `t_id` = :img_id";
            $stmt = self::Connect() -> prepare($sql);
            $stmt -> bindParam("img_id", $img_id, PDO::PARAM_INT);
            $stmt -> execute();
            $row = $stmt->fetch(); 
            return (array) $row;
        }



    }

