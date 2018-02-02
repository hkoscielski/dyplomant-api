<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

include_once '../config/database.php';
include_once '../objects/subject.php';

$database = new Database();
$db = $database->getConnection();

$subject = new Subject($db);

$subject->id_subject = isset($_GET['id_subject']) ? $_GET['id_subject'] : die();

$subject->readOne();

$subjects_arr = array(
	"id_subject" =>  $subject->id_subject,
    "id_supervisor" =>  $subject->id_supervisor,
    "subject_pl" => $subject->subject_pl,
    "subject_en" => $subject->subject_en,
    "taken_up" => $subject->taken_up,
    "graduates_limit" => $subject->graduates_limit,
    "id_subject_status" => $subject->id_subject_status      
);

print_r(json_encode($subjects_arr));
?>