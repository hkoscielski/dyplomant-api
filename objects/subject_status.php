<?php
class SubjectStatus {
 
    // database connection and table name
    private $conn;
    private $table_name = "subject_statuses";
 
    // object properties
    public $id_subject_status;
    public $status_name;    
 
    // constructor with $db as database connection
    public function __construct($db) {
        $this->conn = $db;
    }

    // read subject statuses
    function read() {
     
        // select all query
        $query = "SELECT
                    id_subject_status, 
                    status_name                    
                  FROM " . $this->table_name . 
                  " ORDER BY id_subject_status";
     
        // prepare query statement
        $stmt = $this->conn->prepare($query);
     
        // execute query
        $stmt->execute();
     
        return $stmt;
    }   
}