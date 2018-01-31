<?php
class Graduate {
 
    // database connection and table name
    private $conn;
    private $table_name = "graduates";
 
    // object properties
    public $id_graduate;
    public $id_subject;
    public $name;
    public $surname;
    public $student_no;
    public $speciality;
    public $id_form;
    public $year_of_studies;    
 
    // constructor with $db as database connection
    public function __construct($db) {
        $this->conn = $db;
    }

    // read graduates
    function read() {
     
        // select all query
        $query = "SELECT
                    id_graduate, 
                    id_subject, 
                    name, 
                    surname,
                    student_no,
                    speciality,
                    id_form,
                    year_of_studies                    
                  FROM " . $this->table_name . 
                  " ORDER BY surname, name";
     
        // prepare query statement
        $stmt = $this->conn->prepare($query);
     
        // execute query
        $stmt->execute();
     
        return $stmt;
    }    

    // update graduate
    function update() {
     
        // update query
        $query = "UPDATE " . $this->table_name . "
                  SET id_subject=:id_subject                      
                  WHERE id_graduate=:id_graduate";
     
        // prepare query statement
        $stmt = $this->conn->prepare($query);
     
        // sanitize
        $this->id_graduate=htmlspecialchars(strip_tags($this->id_graduate)); 
        $this->id_subject=htmlspecialchars(strip_tags($this->id_subject));        
     
        // bind new values        
        $stmt->bindParam(":id_subject", $this->id_subject);    
        $stmt->bindParam(":id_graduate", $this->id_graduate);        
     
        // execute the query
        if($stmt->execute()) {
            return true;
        }
     
        return false;
    }    

    function readOne(){
	 
	    // query to read single record
	    $query = "SELECT
	              	id_graduate, 
                    id_subject, 
                    name, 
                    surname,
                    student_no,
                    speciality,
                    id_form,
                    year_of_studies                      
                  FROM " . $this->table_name . 
                  " WHERE id_graduate = ?
                   LIMIT 0,1";              
	 
	    // prepare query statement
	    $stmt = $this->conn->prepare( $query );
	 
	    // bind id of graduate to be updated
	    $stmt->bindParam(1, $this->id_graduate);
	 
	    // execute query
	    $stmt->execute();
	 
	    // get retrieved row
	    $row = $stmt->fetch(PDO::FETCH_ASSOC);
	 
	    // set values to object properties	    
	    $this->id_subject = $row['id_subject'];
	    $this->name = $row['name'];
	    $this->surname = $row['surname'];
	    $this->student_no = $row['student_no'];
	    $this->speciality = $row['speciality'];
	    $this->id_form = $row['id_form'];
	    $this->year_of_studies = $row['year_of_studies'];
	}   
}