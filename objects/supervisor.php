<?php
class Supervisor {
 
    // database connection and table name
    private $conn;
    private $table_name = "supervisors";
 
    // object properties
    public $id_supervisor;
    public $academic_title;
    public $name;
    public $surname;
    public $id_department;    
 
    // constructor with $db as database connection
    public function __construct($db) {
        $this->conn = $db;
    }

    // read supervisors
    function read() {
     
        // select all query
        $query = "SELECT
                    id_supervisor, 
                    academic_title, 
                    name, 
                    surname,
                    id_department                    
                  FROM " . $this->table_name . 
                  " ORDER BY surname, name";
     
        // prepare query statement
        $stmt = $this->conn->prepare($query);
     
        // execute query
        $stmt->execute();
     
        return $stmt;
    }    
}