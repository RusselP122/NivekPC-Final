<?php

class Database {
 
    private $server = "mysql:host=localhost;dbname=u936666569_nivekpc"; 
    private $username = "u936666569_root";  
    private $password = "RUsselNevermore122"; 
    private $options  = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    );
    protected $conn;
    
    public function open() {
        try {
            $this->conn = new PDO($this->server, $this->username, $this->password, $this->options);
            return $this->conn;
        } catch (PDOException $e) {
            
            die("Connection failed: " . $e->getMessage());
        }
    }
 
    public function close() {
        
        $this->conn = null;
    }
 
}


$database = new Database();


$pdo = $database->open();

