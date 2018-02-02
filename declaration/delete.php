<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
include_once '../config/database.php';
include_once '../objects/declaration.php';

$database = new Database();
$db = $database->getConnection();
 
$declaration = new Declaration($db);
 
$data = json_decode(file_get_contents("php://input"));

$declaration->id_declaration = $data->id_declaration;

if($declaration->delete()){
    echo '{';
        echo '"message": "Declaration was deleted."';
    echo '}';
} 
else{
    echo '{';
        echo '"message": "Unable to delete declaration."';
    echo '}';
}
?>