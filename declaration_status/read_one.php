<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

include_once '../config/database.php';
include_once '../objects/declaration_status.php';

$database = new Database();
$db = $database->getConnection();

$declaration_status = new DeclarationStatus($db);

$declaration_status->status_name = isset($_GET['status_name']) ? $_GET['status_name'] : die();
 
$declaration_status->readOne();

$declaration_status_arr = array(
    "id_declaration_status" =>  $declaration_status->id_declaration_status,
    "status_name" => $declaration_status->status_name      
);
print_r(json_encode($declaration_status_arr));
?>