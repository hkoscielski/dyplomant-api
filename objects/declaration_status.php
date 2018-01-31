<?php
class DeclarationStatus {
 
    // database connection and table name
    private $conn;
    private $table_name = "declaration_statuses";
 
    // object properties
    public $id_declaration_status;
    public $status_name;    
 
    // constructor with $db as database connection
    public function __construct($db) {
        $this->conn = $db;
    }

    // read declaration statuses
    function read() {
     
        // select all query
        $query = "SELECT
                    id_declaration_status, 
                    status_name                    
                  FROM " . $this->table_name . 
                  " ORDER BY id_declaration_status";
     
        // prepare query statement
        $stmt = $this->conn->prepare($query);
     
        // execute query
        $stmt->execute();
     
        return $stmt;
    }   

    function readOne(){
     
        // query to read single record
        $query = "SELECT
                    id_declaration_status, 
                    status_name                       
                  FROM " . $this->table_name . 
                  " WHERE status_name = ?
                   LIMIT 0,1";              
     
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
     
        // bind name of declaration status to be updated
        $stmt->bindParam(1, $this->status_name);
     
        // execute query
        $stmt->execute();
     
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
     
        // set values to object properties      
        $this->id_declaration_status = $row['id_declaration_status'];        
    }   
}