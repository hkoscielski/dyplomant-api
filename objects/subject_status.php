<?php
class SubjectStatus {

    private $conn;
    private $table_name = "subject_statuses";

    public $id_subject_status;
    public $status_name;    

    public function __construct($db) {
        $this->conn = $db;
    }

    function read() {

        $query = "SELECT
                    id_subject_status, 
                    status_name                    
                  FROM " . $this->table_name . 
                  " ORDER BY id_subject_status";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();
     
        return $stmt;
    }   

    function readOne(){

        $query = "SELECT
                    id_subject_status, 
                    status_name                       
                  FROM " . $this->table_name . 
                  " WHERE status_name = ?
                   LIMIT 0,1";              
     
        $stmt = $this->conn->prepare( $query );

        $stmt->bindParam(1, $this->status_name);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
     
        $this->id_subject_status = $row['id_subject_status'];        
    }   
}