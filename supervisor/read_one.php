<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

include_once '../config/database.php';
include_once '../objects/supervisor.php';

$database = new Database();
$db = $database->getConnection();

$supervisor = new Supervisor($db);

$supervisor->id_supervisor = isset($_GET['id_supervisor']) ? $_GET['id_supervisor'] : die();

$supervisor->readOne();

$supervisors_arr = array(
    "id_supervisor" =>  $supervisor->id_supervisor,
    "academic_title" => $supervisor->academic_title,
    "name" => $supervisor->name,
    "surname" => $supervisor->surname,
    "id_department" => $supervisor->id_department    
);

print_r(json_encode($supervisors_arr));
?>