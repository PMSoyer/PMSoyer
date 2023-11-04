<?php


    /**
     * Important: Temporary use
     */


    namespace App\Models;

    use Database\MySql;
    use PDO;
    use PDOException;

    class BaseModel extends MySql {


        private string $__table__;
        private string $stmt;
        private array $params = [];
        private $query_exec;
        private PDO $pdo;


        public function __construct($table) {
            $this -> __table__ = $table;
            parent::__construct(); // update parent constructor
            $this -> pdo = $this -> connect();
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
            $this -> query_exec = $this -> pdo -> prepare($this -> stmt);
            for($i = 0; $i < count($this -> params); $i++){
                if (is_string($this -> params[$i])) {
                    $this -> query_exec -> bindValue($i + 1, $this -> params[$i], PDO::PARAM_STR);
                } else if (is_int($this -> params[$i])) {
                    $this -> query_exec -> bindValue($i + 1, $this -> params[$i], PDO::PARAM_INT);
                } else {
                    $this -> query_exec -> bindValue($i + 1, $this -> params[$i]);
                }
            }
            $this -> query_exec -> execute();
            $this -> params = []; // reset params
            return $this; // return instance
        }


        public function execute() {
            $this -> query_exec = $this -> pdo -> prepare($this -> stmt);
            for($i = 0; $i < count($this -> params); $i++){
                if (is_string($this -> params[$i])) {
                    $this -> query_exec -> bindValue($i + 1, $this -> params[$i], PDO::PARAM_STR);
                } else if (is_int($this -> params[$i])) {
                    $this -> query_exec -> bindValue($i + 1, $this -> params[$i], PDO::PARAM_INT);
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


        public function beginTransaction(){
            $this -> pdo -> beginTransaction();
            return $this;
        }
    

        public function commit(){
            $this -> pdo -> commit();
            return $this;
        }
    

        public function rollBack(){
            $this -> pdo -> rollBack();
            return $this;
        }


        public function executeTransaction(){
            try {
                $this->pdo->beginTransaction();
    
                $this->execute(); // Or use executeWith() method if needed
    
                $this->pdo->commit();
            } catch (PDOException $e) {
                $this->pdo->rollBack();
                throw $e; // Propagate the exception after rolling back the transaction
            }
            // // example for use executeTransaction
            // try {
            //     $db->beginTransaction();
            //     // Insert operation 1
            //     $result1 = $db->CustomStmt("INSERT INTO table1 (column1, column2) VALUES (?, ?)", ['value1', 'value2'])->executeTransaction();
            //     // Insert operation 2
            //     $result2 = $db->CustomStmt("INSERT INTO table2 (columnA, columnB) VALUES (?, ?)", ['valueA', 'valueB'])->executeTransaction();
            //     $db->commit();
            //     echo "Transaction successfully executed.";
            // } catch (PDOException $e) {
            //     $db->rollBack();
            //     echo "Transaction failed: " . $e->getMessage();
            // }
        }



        public function getStatement(){
            echo $this -> stmt . "\n";
        }


        public function getParams() {
            print_r($this -> params);
        }
    }