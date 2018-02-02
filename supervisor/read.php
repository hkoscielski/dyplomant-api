<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/supervisor.php';

$database = new Database();
$db = $database->getConnection();

$supervisor = new Supervisor($db);

$stmt = $supervisor->read();
$num = $stmt->rowCount();

if($num>0) {

    $supervisor_arr=array();
    $supervisor_arr["supervisors"]=array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        extract($row);
 
        $supervisor_item=array(
            "id_supervisor" => $id_supervisor,
            "academic_title" => $academic_title,
            "name" => $name,
            "surname" => $surname,
            "id_department" => $id_department           
        );
 
        array_push($supervisor_arr["supervisors"], $supervisor_item);
    }
 
    echo json_encode($supervisor_arr);
}
 
else {
    echo json_encode(
        array("message" => "No supervisors found.")
    );
}
?>