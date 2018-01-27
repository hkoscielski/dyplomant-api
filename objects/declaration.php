<?php
class Declaration {
 
    // database connection and table name
    private $conn;
    private $table_name = "Declarations";
 
    // object properties
    public $id_declaration;
    public $id_subject;
    public $id_graduate;
    public $language;
    public $purpose_range;
    public $short_desc;
    public $submit_date;
    public $supervisor_sign_date;
    public $id_declaration_status;
 
    // constructor with $db as database connection
    public function __construct($db) {
        $this->conn = $db;
    }

    // read declarations
    function read() {
     
        // select all query
        $query = "SELECT
                    id_declaration, 
                    id_subject, 
                    id_graduate, 
                    language,
                    purpose_range,
                    short_desc,
                    submit_date,
                    supervisor_sign_date,
                    id_declaration_status 
                  FROM " . $this->table_name . 
                  " ORDER BY id_declaration";
     
        // prepare query statement
        $stmt = $this->conn->prepare($query);
     
        // execute query
        $stmt->execute();
     
        return $stmt;
    }

    // create declaration
    function create() {
     
        // query to insert record
        $query = "INSERT INTO " . $this->table_name . "
                  SET
                      id_declaration=:id_declaration, 
                      id_subject=:id_subject, 
                      id_graduate=:id_graduate, 
                      language=:language, 
                      purpose_range=:purpose_range,
                      short_desc=:short_desc, 
                      submit_date=:submit_date, 
                      supervisor_sign_date=:supervisor_sign_date, 
                      id_declaration_status=:id_declaration_status";
     
        // prepare query
        $stmt = $this->conn->prepare($query);
     
        // sanitize
        $this->id_declaration=htmlspecialchars(strip_tags($this->id_declaration));
        $this->id_subject=htmlspecialchars(strip_tags($this->id_subject));
        $this->id_graduate=htmlspecialchars(strip_tags($this->id_graduate));
        $this->language=htmlspecialchars(strip_tags($this->language));
        $this->purpose_range=htmlspecialchars(strip_tags($this->purpose_range));
        $this->short_desc=htmlspecialchars(strip_tags($this->short_desc));
        $this->submit_date=htmlspecialchars(strip_tags($this->submit_date));
        $this->supervisor_sign_date=htmlspecialchars(strip_tags($this->supervisor_sign_date));
        $this->id_declaration_status=htmlspecialchars(strip_tags($this->id_declaration_status));
     
        // bind values
        $stmt->bindParam(":id_declaration", $this->id_declaration);
        $stmt->bindParam(":id_subject", $this->id_subject);
        $stmt->bindParam(":id_graduate", $this->id_graduate);
        $stmt->bindParam(":language", $this->language);
        $stmt->bindParam(":purpose_range", $this->purpose_range);
        $stmt->bindParam(":short_desc", $this->short_desc);
        $stmt->bindParam(":submit_date", $this->submit_date);
        $stmt->bindParam(":supervisor_sign_date", $this->supervisor_sign_date);
        $stmt->bindParam(":id_declaration_status", $this->id_declaration_status);
     
        // execute query
        if($stmt->execute()) {
            return true;
        }
     
        return false;         
    }

    // update declaration
    function update() {
     
        // update query
        $query = "UPDATE " . $this->table_name . "
                  SET
                    id_subject=:id_subject, 
                      id_graduate=:id_graduate, 
                      language=:language, 
                      purpose_range=:purpose_range,
                      short_desc=:short_desc, 
                      submit_date=:submit_date, 
                      supervisor_sign_date=:supervisor_sign_date, 
                      id_declaration_status=:id_declaration_status
                  WHERE id_declaration=:id_declaration";
     
        // prepare query statement
        $stmt = $this->conn->prepare($query);
     
        // sanitize
        $this->id_subject=htmlspecialchars(strip_tags($this->id_subject));
        $this->id_graduate=htmlspecialchars(strip_tags($this->id_graduate));
        $this->language=htmlspecialchars(strip_tags($this->language));
        $this->purpose_range=htmlspecialchars(strip_tags($this->purpose_range));
        $this->short_desc=htmlspecialchars(strip_tags($this->short_desc));
        $this->submit_date=htmlspecialchars(strip_tags($this->submit_date));
        $this->supervisor_sign_date=htmlspecialchars(strip_tags($this->supervisor_sign_date));
        $this->id_declaration_status=htmlspecialchars(strip_tags($this->id_declaration_status));
     
        // bind new values        
        $stmt->bindParam(":id_subject", $this->id_subject);
        $stmt->bindParam(":id_graduate", $this->id_graduate);
        $stmt->bindParam(":language", $this->language);
        $stmt->bindParam(":purpose_range", $this->purpose_range);
        $stmt->bindParam(":short_desc", $this->short_desc);
        $stmt->bindParam(":submit_date", $this->submit_date);
        $stmt->bindParam(":supervisor_sign_date", $this->supervisor_sign_date);
        $stmt->bindParam(":id_declaration_status", $this->id_declaration_status);
     
        // execute the query
        if($stmt->execute()) {
            return true;
        }
     
        return false;
    }

    // delete declaration
    function delete() {
     
        // delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
     
        // prepare query
        $stmt = $this->conn->prepare($query);
     
        // sanitize
        $this->id_declaration=htmlspecialchars(strip_tags($this->id_declaration));
     
        // bind id of record to delete
        $stmt->bindParam(1, $this->id_declaration);
     
        // execute query
        if($stmt->execute()) {
            return true;
        }
     
        return false;
         
    }
}