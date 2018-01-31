<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/subject.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare subject object
$subject = new Subject($db);
 
// set ID property of subject to be edited
$subject->id_subject = isset($_GET['id_subject']) ? $_GET['id_subject'] : die();
 
// read the details of subject to be edited
$subject->readOne();
 
// create array
$subjects_arr = array(
	"id_subject" =>  $subject->id_subject,
    "id_supervisor" =>  $subject->id_supervisor,
    "subject_pl" => $subject->subject_pl,
    "subject_en" => $subject->subject_en,
    "taken_up" => $subject->taken_up,
    "graduates_limit" => $subject->graduates_limit,
    "id_subject_status" => $subject->id_subject_status      
);
 
// make it json format
print_r(json_encode($subjects_arr));
?>