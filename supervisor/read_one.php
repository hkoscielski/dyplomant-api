<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/supervisor.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare supervisor object
$supervisor = new Supervisor($db);
 
// set ID property of supervisor to be edited
$supervisor->id_supervisor = isset($_GET['id_supervisor']) ? $_GET['id_supervisor'] : die();
 
// read the details of supervisor to be edited
$supervisor->readOne();
 
// create array
$supervisors_arr = array(
    "id_supervisor" =>  $supervisor->id_supervisor,
    "academic_title" => $supervisor->academic_title,
    "name" => $supervisor->name,
    "surname" => $supervisor->surname,
    "id_department" => $supervisor->id_department    
);
 
// make it json format
print_r(json_encode($supervisors_arr));
?>