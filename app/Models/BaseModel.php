<?php


    /**
     * Important: Temporary use
     */


    namespace App\Models;

    use Database\MySql;
    use PDO;

    class BaseModel extends MySql {


        private string $__table__;
        private string $stmt;
        private array $params = [];
        private $query_exec;


        public function __construct($table) {
            $this -> __table__ = $table;
            parent::__construct();
        }


        public function Select(string $params = "*"){
            $this -> stmt = "SELECT " . $params . " FROM " . $this -> __table__;
            return $this; // return instance
        }


        public function Create(array $columns, array $params){
            $this -> stmt = "INSERT INTO " . $this -> __table__ . " (";
            $this -> stmt .= implode(', ', $columns);
            $this -> stmt .= ") VALUES (";
            $this -> stmt .= implode(', ', array_fill(0, count($columns), '?'));
            $this -> stmt .= ")";
            $this -> params = array_merge($this -> params, $params);
            return $this; // return instance
        }


        public function Update(array $columns, array $params){
            $this -> stmt = "UPDATE " . $this -> __table__ . " SET ";
            $setColumns = [];
            foreach ($columns as $column) {
                $setColumns[] = $column . "=?";
            }
            $this -> stmt .= implode(', ', $setColumns);
            $this -> params = array_merge($this -> params, $params);
            return $this; // return instance
        }


        public function Delete(){
            $this -> stmt = "DELETE FROM " . $this -> __table__;
            return $this; // return instance
        }



        public function CustomStmt(string $stmt, array $params = []){
            $this -> stmt = $stmt;
            $this -> params = array_merge($this -> params, $params);
            return $this; // return instance
        }

    

        public function where(string $conditions, array $params = []){
            $this -> stmt .= " WHERE " . $conditions;
            $this -> params = array_merge($this -> params, $params);
            return $this; // return instance
        }


        public function executeWith() {
            $this -> query_exec = $this -> connect() -> prepare($this -> stmt);
            for($i = 0; $i < count($this -> params); $i++){
                if (is_string($this -> params[$i])) {
                    $this -> query_exec -> bindValue($i + 1, $this -> params[$i], PDO::PARAM_STR);
                } else {
                    $this -> query_exec -> bindValue($i + 1, $this -> params[$i]);
                }
            }
            $this -> query_exec -> execute();
            $this -> params = []; // reset params
            return $this; // return instance
        }


        public function execute() {
            $this -> query_exec = $this -> connect() -> prepare($this -> stmt);
            for($i = 0; $i < count($this -> params); $i++){
                if (is_string($this -> params[$i])) {
                    $this -> query_exec -> bindValue($i + 1, $this -> params[$i], PDO::PARAM_STR);
                } else {
                    $this -> query_exec -> bindValue($i + 1, $this -> params[$i]);
                }
            }
            $this -> params = []; // reset params
            return $this -> query_exec -> execute(); // return result
        }
    

        public function findOne(){
            return $this -> query_exec -> fetch(PDO::FETCH_ASSOC); // return result
        }


        public function findAll(){
            return $this -> query_exec -> fetchAll(PDO::FETCH_ASSOC); // return result
        }


        public function getStatement(){
            echo $this -> stmt . "\n";
        }


        public function getParams() {
            print_r($this -> params);
        }
    }