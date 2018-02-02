<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/declaration_status.php';

$database = new Database();
$db = $database->getConnection();

$declaration_status = new DeclarationStatus($db);

$stmt = $declaration_status->read();
$num = $stmt->rowCount();

if($num>0) {

    $declaration_status_arr=array();
    $declaration_status_arr["declaration_statuses"]=array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        extract($row);
 
        $declaration_status_item=array(
            "id_declaration_status" => $id_declaration_status,
            "status_name" => $status_name            
        );
 
        array_push($declaration_status_arr["declaration_statuses"], $declaration_status_item);
    }
 
    echo json_encode($declaration_status_arr);
}
 
else {
    echo json_encode(
        array("message" => "No declaration status found.")
    );
}
?>