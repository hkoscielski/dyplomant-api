<?php
class Department {

    private $conn;
    private $table_name = "departments";

    public $id_department;
    public $department_name;    

    public function __construct($db) {
        $this->conn = $db;
    }

    function read() {

        $query = "SELECT
                    id_department, 
                    department_name                    
                  FROM " . $this->table_name . 
                  " ORDER BY department_name";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();
     
        return $stmt;
    }   
}