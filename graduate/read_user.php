<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

include_once '../config/database.php';
include_once '../objects/graduate.php';

$database = new Database();
$db = $database->getConnection();

$graduate = new Graduate($db);
 
$graduate->student_no = isset($_GET['student_no']) ? $_GET['student_no'] : die();

if($graduate->count($graduate->student_no) == 0) {
	die();
}
 
$graduate->readUser();

$graduates_arr = array(
    "id_graduate" =>  $graduate->id_graduate,
    "id_subject" => $graduate->id_subject,
    "name" => $graduate->name,
    "surname" => $graduate->surname,
    "student_no" => $graduate->student_no,    
    "speciality" => $graduate->speciality,
    "id_form" => $graduate->id_form,
    "year_of_studies" => $graduate->year_of_studies
);

print_r(json_encode($graduates_arr));
?>