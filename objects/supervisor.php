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

    function readOne(){
	 
	    // query to read single record
	    $query = "SELECT
	              	id_supervisor, 
                    academic_title, 
                    name, 
                    surname,
                    id_department                    
                  FROM " . $this->table_name . 
                  " WHERE id_supervisor = ?
                   LIMIT 0,1";              
	 
	    // prepare query statement
	    $stmt = $this->conn->prepare( $query );
	 
	    // bind id of product to be updated
	    $stmt->bindParam(1, $this->id_supervisor);
	 
	    // execute query
	    $stmt->execute();
	 
	    // get retrieved row
	    $row = $stmt->fetch(PDO::FETCH_ASSOC);
	 
	    // set values to object properties	    
	    $this->academic_title = $row['academic_title'];
	    $this->name = $row['name'];
	    $this->surname = $row['surname'];
	    $this->id_department = $row['id_department'];
	}   
}