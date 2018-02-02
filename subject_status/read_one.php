<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

include_once '../config/database.php';
include_once '../objects/subject_status.php';

$database = new Database();
$db = $database->getConnection();

$subject_status = new SubjectStatus($db);

$subject_status->status_name = isset($_GET['status_name']) ? $_GET['status_name'] : die();

$subject_status->readOne();

$subject_status_arr = array(
    "id_subject_status" =>  $subject_status->id_subject_status,
    "status_name" => $subject_status->status_name      
);

print_r(json_encode($subject_status_arr));
?>