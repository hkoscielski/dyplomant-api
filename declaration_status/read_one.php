<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/declaration_status.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare declaration_status object
$declaration_status = new DeclarationStatus($db);
 
// set name property of declaration_status to be edited
$declaration_status->status_name = isset($_GET['status_name']) ? $_GET['status_name'] : die();
 
// read the details of declaration_status to be edited
$declaration_status->readOne();
 
// create array
$declaration_status_arr = array(
    "id_declaration_status" =>  $declaration_status->id_declaration_status,
    "status_name" => $declaration_status->status_name      
);
 
// make it json format
print_r(json_encode($declaration_status_arr));
?>