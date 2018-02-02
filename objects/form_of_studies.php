<?php
class FormOfStudies {
 
    // database connection and table name
    private $conn;
    private $table_name = "forms_of_studies";
 
    // object properties
    public $id_form;
    public $form_name;    
 
    // constructor with $db as database connection
    public function __construct($db) {
        $this->conn = $db;
    }

    // read forms of studies
    function read() {
     
        // select all query
        $query = "SELECT
                    id_form, 
                    form_name                    
                  FROM " . $this->table_name . 
                  " ORDER BY id_form";
     
        // prepare query statement
        $stmt = $this->conn->prepare($query);
     
        // execute query
        $stmt->execute();
     
        return $stmt;
    }   

    function readOne(){
     
        // query to read single record
        $query = "SELECT
                    id_form, 
                    form_name                           
                  FROM " . $this->table_name . 
                  " WHERE id_form = ?
                   LIMIT 0,1";              
     
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
     
        // bind name of form of studies to be updated
        $stmt->bindParam(1, $this->id_form);
     
        // execute query
        $stmt->execute();
     
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
     
        // set values to object properties      
        $this->form_name = $row['form_name'];        
    }   
}