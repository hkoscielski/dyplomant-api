<?php
class FormOfStudies {

    private $conn;
    private $table_name = "forms_of_studies";

    public $id_form;
    public $form_name;    

    public function __construct($db) {
        $this->conn = $db;
    }

    function read() {

        $query = "SELECT
                    id_form, 
                    form_name                    
                  FROM " . $this->table_name . 
                  " ORDER BY id_form";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();
     
        return $stmt;
    }   

    function readOne(){

        $query = "SELECT
                    id_form, 
                    form_name                           
                  FROM " . $this->table_name . 
                  " WHERE id_form = ?
                   LIMIT 0,1";              

        $stmt = $this->conn->prepare( $query );

        $stmt->bindParam(1, $this->id_form);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
      
        $this->form_name = $row['form_name'];        
    }   
}