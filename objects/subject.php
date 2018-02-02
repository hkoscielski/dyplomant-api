<?php
class Subject {

    private $conn;
    private $table_name = "subjects";
    
    public $id_subject;
    public $id_supervisor;
    public $subject_pl;
    public $subject_en;
    public $taken_up;
    public $graduates_limit;
    public $id_subject_status;    

    public function __construct($db) {
        $this->conn = $db;
    }

    function read() {

        $query = "SELECT
                    id_subject, 
                    id_supervisor, 
                    subject_pl,
                    subject_en,
                    taken_up,
                    graduates_limit,
                    id_subject_status
                  FROM " . $this->table_name . 
                  " ORDER BY id_subject";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();
     
        return $stmt;
    }    

    function readOne(){

        $query = "SELECT
                    id_subject, 
                    id_supervisor, 
                    subject_pl,
                    subject_en,
                    taken_up,
                    graduates_limit,
                    id_subject_status               
                  FROM " . $this->table_name . 
                  " WHERE id_subject = ?
                   LIMIT 0,1";              

        $stmt = $this->conn->prepare( $query );

        $stmt->bindParam(1, $this->id_subject);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
     
        $this->id_supervisor = $row['id_supervisor'];
        $this->subject_pl = $row['subject_pl'];
        $this->subject_en = $row['subject_en'];
        $this->taken_up = $row['taken_up'];
        $this->graduates_limit = $row['graduates_limit'];
        $this->id_subject_status = $row['id_subject_status'];
    }   

    function update() {

        $query = "UPDATE " . $this->table_name . " 
                  SET taken_up=:taken_up,                      
                      id_subject_status=:id_subject_status                      
                  WHERE id_subject=:id_subject";

        $stmt = $this->conn->prepare($query);
             
        $this->taken_up=htmlspecialchars(strip_tags($this->taken_up));        
        $this->id_subject_status=htmlspecialchars(strip_tags($this->id_subject_status));   
        $this->id_subject=htmlspecialchars(strip_tags($this->id_subject));       
                    
        $stmt->bindParam(":taken_up", $this->taken_up);        
        $stmt->bindParam(":id_subject_status", $this->id_subject_status);       
        $stmt->bindParam(":id_subject", $this->id_subject);  

        if($stmt->execute()) {
            return true;
        }
     
        return false;
    }    
}