<?php

class Sql extends PDO {
    private $conn;
    
    public function __construct() {
        $this->conn = new PDO("mysql:host=localhost;dbname=dbphp7","root","");
    }
    
    // chama varios parametros
    private function setParams($statement, $parameters = array()){
         foreach ($parameters as $key => $value) {
            $this->setParam($statement, $key, $value);
        }
    } 
    // Chama um parametro 
    private function setParam($statement, $key, $value){
        $statement->bindParam($key, $value);
    }
    
    public function query($rawQuery, $params = array()) {
        $stmt = $this->conn->prepare($rawQuery);
        $this->setParams($stmt, $params);
        
        //Executa a Query no banco
        $stmt->execute();
        
        return $stmt;
        
    }
    // Seleciona os campos no banco
    public function select($rawQuery, $params = array()):array{
        $stmt = $this->query($rawQuery, $params);
        
       return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
