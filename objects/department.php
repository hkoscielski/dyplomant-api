<?php
class Department {
 
    // database connection and table name
    private $conn;
    private $table_name = "departments";
 
    // object properties
    public $id_department;
    public $department_name;    
 
    // constructor with $db as database connection
    public function __construct($db) {
        $this->conn = $db;
    }

    // read subject statuses
    function read() {
     
        // select all query
        $query = "SELECT
                    id_department, 
                    department_name                    
                  FROM " . $this->table_name . 
                  " ORDER BY department_name";
     
        // prepare query statement
        $stmt = $this->conn->prepare($query);
     
        // execute query
        $stmt->execute();
     
        return $stmt;
    }   
}