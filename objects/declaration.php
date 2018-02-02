<?php
class Declaration {

    private $conn;
    private $table_name = "Declarations";

    public $id_declaration;
    public $id_subject;
    public $id_graduate;
    public $language;
    public $purpose_range;
    public $short_desc;
    public $submit_date;
    public $supervisor_sign_date;
    public $id_declaration_status;
 
    public function __construct($db) {
        $this->conn = $db;
    }

    function read() {

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

        $stmt = $this->conn->prepare($query);

        $stmt->execute();
     
        return $stmt;
    }

    function create() {

        $query = "INSERT INTO " . $this->table_name .
                  " SET id_declaration=:id_declaration, 
                      id_subject=:id_subject, 
                      id_graduate=:id_graduate, 
                      language=:language, 
                      purpose_range=:purpose_range,
                      short_desc=:short_desc, 
                      submit_date=:submit_date, 
                      supervisor_sign_date=:supervisor_sign_date, 
                      id_declaration_status=:id_declaration_status";

        $stmt = $this->conn->prepare($query);

        $this->id_declaration=htmlspecialchars(strip_tags($this->id_declaration));
        $this->id_subject=htmlspecialchars(strip_tags($this->id_subject));
        $this->id_graduate=htmlspecialchars(strip_tags($this->id_graduate));
        $this->language=htmlspecialchars(strip_tags($this->language));
        $this->purpose_range=htmlspecialchars(strip_tags($this->purpose_range));
        $this->short_desc=htmlspecialchars(strip_tags($this->short_desc));
        $this->submit_date=htmlspecialchars(strip_tags($this->submit_date));
        $this->supervisor_sign_date=htmlspecialchars(strip_tags($this->supervisor_sign_date));
        $this->id_declaration_status=htmlspecialchars(strip_tags($this->id_declaration_status));

        $stmt->bindParam(":id_declaration", $this->id_declaration);
        $stmt->bindParam(":id_subject", $this->id_subject);
        $stmt->bindParam(":id_graduate", $this->id_graduate);
        $stmt->bindParam(":language", $this->language);
        $stmt->bindParam(":purpose_range", $this->purpose_range);
        $stmt->bindParam(":short_desc", $this->short_desc);
        $stmt->bindParam(":submit_date", $this->submit_date);
        $stmt->bindParam(":supervisor_sign_date", $this->supervisor_sign_date);
        $stmt->bindParam(":id_declaration_status", $this->id_declaration_status);

        if($stmt->execute()) {
            return true;
        }
     
        return false;         
    }

    function update() {

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

        $stmt = $this->conn->prepare($query);

        $this->id_subject=htmlspecialchars(strip_tags($this->id_subject));
        $this->id_graduate=htmlspecialchars(strip_tags($this->id_graduate));
        $this->language=htmlspecialchars(strip_tags($this->language));
        $this->purpose_range=htmlspecialchars(strip_tags($this->purpose_range));
        $this->short_desc=htmlspecialchars(strip_tags($this->short_desc));
        $this->submit_date=htmlspecialchars(strip_tags($this->submit_date));
        $this->supervisor_sign_date=htmlspecialchars(strip_tags($this->supervisor_sign_date));
        $this->id_declaration_status=htmlspecialchars(strip_tags($this->id_declaration_status));
       
        $stmt->bindParam(":id_subject", $this->id_subject);
        $stmt->bindParam(":id_graduate", $this->id_graduate);
        $stmt->bindParam(":language", $this->language);
        $stmt->bindParam(":purpose_range", $this->purpose_range);
        $stmt->bindParam(":short_desc", $this->short_desc);
        $stmt->bindParam(":submit_date", $this->submit_date);
        $stmt->bindParam(":supervisor_sign_date", $this->supervisor_sign_date);
        $stmt->bindParam(":id_declaration_status", $this->id_declaration_status);

        if($stmt->execute()) {
            return true;
        }
     
        return false;
    }

    function delete() {

        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";

        $stmt = $this->conn->prepare($query);

        $this->id_declaration=htmlspecialchars(strip_tags($this->id_declaration));

        $stmt->bindParam(1, $this->id_declaration);

        if($stmt->execute()) {
            return true;
        }
     
        return false;
         
    }
}