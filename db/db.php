<?php

function getDb() {
    $dbConnection = new dbConnection();
    $connectionString = $dbConnection->getDbConnection()->getConnectionString();
    
    try {
        $db = new PDO($connectionString, $dbConnection->login, $dbConnection->password);
    } catch (Exception $ex) {
        die('Erreur : '.$ex->getMessage());
    }
    
    return $db;
}

class dbConnection {
    public $host;
    public $dbname;
    public $login;
    public $password;
    
    public function __construct() {
        $this->host = 'localhost';
        $this->dbname = 'test';
        $this->login = 'root';
        $this->password = '';        
    } 
    
    function getDbConnection($filename = null) {
        if($filename === null) {
            $filename = __DIR__.'/db.xml';
        }
        
        if(file_exists($filename)) {
            $xml = simplexml_load_file($filename);

            $this->host = (string)$xml->host;
            $this->dbname = (string)$xml->dbname;
            $this->login = (string)$xml->login;
            $this->password = (string)$xml->password;
        }  
        
        return $this;
    }
    
    function getConnectionString(dbConnection $dbConnection = null) {
        if($dbConnection === null) {
            $dbConnection = $this;
        }
        $connectionString = sprintf("mysql:host=%s;dbname=%s;charset=utf8", 
                $dbConnection->host, $dbConnection->dbname);
        return $connectionString;        
    }
}


