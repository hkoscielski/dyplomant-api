<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/department.php';

$database = new Database();
$db = $database->getConnection();

$department = new Department($db);

$stmt = $department->read();
$num = $stmt->rowCount();

if($num>0) {

    $department_arr=array();
    $department_arr["departments"]=array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        extract($row);
 
        $department_item=array(
            "id_department" => $id_department,
            "department_name" => $department_name            
        );
 
        array_push($department_arr["departments"], $department_item);
    }
 
    echo json_encode($department_arr);
}
 
else {
    echo json_encode(
        array("message" => "No department found.")
    );
}
?>