<?php
class Supervisor {

    private $conn;
    private $table_name = "supervisors";

    public $id_supervisor;
    public $academic_title;
    public $name;
    public $surname;
    public $id_department;    

    public function __construct($db) {
        $this->conn = $db;
    }

    function read() {

        $query = "SELECT
                    id_supervisor, 
                    academic_title, 
                    name, 
                    surname,
                    id_department                    
                  FROM " . $this->table_name . 
                  " ORDER BY surname, name";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();
     
        return $stmt;
    } 

    function readOne(){

	    $query = "SELECT
	              	id_supervisor, 
                    academic_title, 
                    name, 
                    surname,
                    id_department                    
                  FROM " . $this->table_name . 
                  " WHERE id_supervisor = ?
                   LIMIT 0,1";              

	    $stmt = $this->conn->prepare( $query );

	    $stmt->bindParam(1, $this->id_supervisor);

	    $stmt->execute();

	    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
	    $this->academic_title = $row['academic_title'];
	    $this->name = $row['name'];
	    $this->surname = $row['surname'];
	    $this->id_department = $row['id_department'];
	}   
}