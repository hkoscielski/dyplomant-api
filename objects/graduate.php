<?php
class Graduate {

    private $conn;
    private $table_name = "graduates";

    public $id_graduate;
    public $id_subject;
    public $name;
    public $surname;
    public $student_no;
    public $speciality;
    public $id_form;
    public $year_of_studies;    

    public function __construct($db) {
        $this->conn = $db;
    }

    function read() {

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

        $stmt = $this->conn->prepare($query);

        $stmt->execute();
     
        return $stmt;
    }    

    function update() {

        $query = "UPDATE " . $this->table_name . "
                  SET id_subject=:id_subject                      
                  WHERE id_graduate=:id_graduate";

        $stmt = $this->conn->prepare($query);

        $this->id_graduate=htmlspecialchars(strip_tags($this->id_graduate)); 
        $this->id_subject=htmlspecialchars(strip_tags($this->id_subject));        
       
        $stmt->bindParam(":id_subject", $this->id_subject);    
        $stmt->bindParam(":id_graduate", $this->id_graduate);        

        if($stmt->execute()) {
            return true;
        }
     
        return false;
    }    

    function readOne(){

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

	    $stmt = $this->conn->prepare( $query );

	    $stmt->bindParam(1, $this->id_graduate);

	    $stmt->execute();

	    $row = $stmt->fetch(PDO::FETCH_ASSOC);
	    
	    $this->id_subject = $row['id_subject'];
	    $this->name = $row['name'];
	    $this->surname = $row['surname'];
	    $this->student_no = $row['student_no'];
	    $this->speciality = $row['speciality'];
	    $this->id_form = $row['id_form'];
	    $this->year_of_studies = $row['year_of_studies'];
	}   

    function readUser(){

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
                  " WHERE student_no = ?
                   LIMIT 0,1";              

        $stmt = $this->conn->prepare( $query );

        $stmt->bindParam(1, $this->student_no);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->id_graduate = $row['id_graduate'];    
        $this->id_subject = $row['id_subject'];
        $this->name = $row['name'];
        $this->surname = $row['surname'];        
        $this->speciality = $row['speciality'];
        $this->id_form = $row['id_form'];
        $this->year_of_studies = $row['year_of_studies'];
    }   

    function count($student_no) {

        $query = "SELECT COUNT(*) AS C
                    FROM " . $this->table_name . 
                    " WHERE student_no = ?";

        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $student_no);

        $stmt->execute();

        $num = $stmt->fetch(PDO::FETCH_ASSOC);

        return $num['C'];
    }
}