<?php
class Subject {
 
    // database connection and table name
    private $conn;
    private $table_name = "subjects";
 
    // object properties    
    public $id_subject;
    public $id_supervisor;
    public $subject_pl;
    public $subject_en;
    public $taken_up;
    public $graduates_limit;
    public $id_subject_status;    
 
    // constructor with $db as database connection
    public function __construct($db) {
        $this->conn = $db;
    }

    // read subjects
    function read() {
     
        // select all query
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
     
        // prepare query statement
        $stmt = $this->conn->prepare($query);
     
        // execute query
        $stmt->execute();
     
        return $stmt;
    }    

    // update subject
    function update() {
     
        // update query
        $query = "UPDATE " . $this->table_name . "
                  SET                       
                      id_supervisor=:id_supervisor, 
                      subject_pl=:subject_pl, 
                      subject_en=:subject_en,
                      taken_up=:taken_up, 
                      graduates_limit=:graduates_limit, 
                      id_subject_status=:id_subject_status                      
                  WHERE id_subject=:id_subject";
     
        // prepare query statement
        $stmt = $this->conn->prepare($query);
     
        // sanitize
        $this->id_supervisor=htmlspecialchars(strip_tags($this->id_supervisor));
        $this->subject_pl=htmlspecialchars(strip_tags($this->subject_pl));
        $this->subject_en=htmlspecialchars(strip_tags($this->subject_en));
        $this->taken_up=htmlspecialchars(strip_tags($this->taken_up));
        $this->graduates_limit=htmlspecialchars(strip_tags($this->graduates_limit));
        $this->id_subject_status=htmlspecialchars(strip_tags($this->id_subject_status));        
     
        // bind new values        
        $stmt->bindParam(":id_supervisor", $this->id_supervisor);
        $stmt->bindParam(":subject_pl", $this->subject_pl);
        $stmt->bindParam(":subject_en", $this->subject_en);
        $stmt->bindParam(":taken_up", $this->taken_up);
        $stmt->bindParam(":graduates_limit", $this->graduates_limit);
        $stmt->bindParam(":id_subject_status", $this->id_subject_status);        
     
        // execute the query
        if($stmt->execute()) {
            return true;
        }
     
        return false;
    }    
}