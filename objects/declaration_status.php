<?php
class DeclarationStatus {

    private $conn;
    private $table_name = "declaration_statuses";

    public $id_declaration_status;
    public $status_name;    

    public function __construct($db) {
        $this->conn = $db;
    }

    function read() {

        $query = "SELECT
                    id_declaration_status, 
                    status_name                    
                  FROM " . $this->table_name . 
                  " ORDER BY id_declaration_status";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();
     
        return $stmt;
    }   

    function readOne(){

        $query = "SELECT
                    id_declaration_status, 
                    status_name                       
                  FROM " . $this->table_name . 
                  " WHERE status_name = ?
                   LIMIT 0,1";              

        $stmt = $this->conn->prepare( $query );

        $stmt->bindParam(1, $this->status_name);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        $this->id_declaration_status = $row['id_declaration_status'];        
    }   
}