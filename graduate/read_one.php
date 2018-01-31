<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/graduate.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare graduate object
$graduate = new Graduate($db);
 
// set ID property of graduate to be edited
$graduate->id_graduate = isset($_GET['id_graduate']) ? $_GET['id_graduate'] : die();
 
// read the details of graduate to be edited
$graduate->readOne();
 
// create array
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
 
// make it json format
print_r(json_encode($graduates_arr));
?>