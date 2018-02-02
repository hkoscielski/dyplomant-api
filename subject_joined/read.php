<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/subject_joined.php';

$database = new Database();
$db = $database->getConnection();

$subject = new SubjectJoined($db);

$stmt = $subject->read();
$num = $stmt->rowCount();

if($num>0) {

    $subjects_arr=array();
    $subjects_arr["subjects_joined"]=array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        extract($row);
 
        $subject_item=array(
            "id_subject" => $id_subject,
            "id_supervisor" => $id_supervisor,
            "supervisor" => array(
                "id_supervisor" => $id_supervisor,
                "academic_title" => $academic_title,
                "name" => $name,
                "surname" => $surname
            ),            
            "subject_pl" => $subject_pl,
            "subject_en" => $subject_en,
            "taken_up" => $taken_up,
            "graduates_limit" => $graduates_limit,
            "id_subject_status" => $id_subject_status,
            "subject_status" => array(
                "id_subject_status" => $id_subject_status,
                "status_name" => $status_name          
            )              
        );
 
        array_push($subjects_arr["subjects_joined"], $subject_item);
    }
 
    echo json_encode($subjects_arr);
}
 
else {
    echo json_encode(
        array("message" => "No subjects found.")
    );
}
?>