<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/subject_status.php';

$database = new Database();
$db = $database->getConnection();

$subject_status = new SubjectStatus($db);

$stmt = $subject_status->read();
$num = $stmt->rowCount();

if($num>0) {

    $subject_status_arr=array();
    $subject_status_arr["subject_statuses"]=array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        extract($row);
 
        $subject_status_item=array(
            "id_subject_status" => $id_subject_status,
            "status_name" => $status_name            
        );
 
        array_push($subject_status_arr["subject_statuses"], $subject_status_item);
    }
 
    echo json_encode($subject_status_arr);
}
 
else {
    echo json_encode(
        array("message" => "No subject status found.")
    );
}
?>