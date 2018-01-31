<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/subject_status.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare subject_status object
$subject_status = new SubjectStatus($db);
 
// set name property of subject_status to be edited
$subject_status->status_name = isset($_GET['status_name']) ? $_GET['status_name'] : die();
 
// read the details of subject_status to be edited
$subject_status->readOne();
 
// create array
$subject_status_arr = array(
    "id_subject_status" =>  $subject_status->id_subject_status,
    "status_name" => $subject_status->status_name      
);
 
// make it json format
print_r(json_encode($subject_status_arr));
?>