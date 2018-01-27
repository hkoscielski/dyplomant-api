<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
 
// include database and object file
include_once '../config/database.php';
include_once '../objects/declaration.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare declaration object
$declaration = new Declaration($db);
 
// get declaration id
$data = json_decode(file_get_contents("php://input"));
 
// set declaration id to be deleted
$declaration->id_declaration = $data->id_declaration;
 
// delete the declaration
if($declaration->delete()){
    echo '{';
        echo '"message": "Declaration was deleted."';
    echo '}';
}
 
// if unable to delete the declaration
else{
    echo '{';
        echo '"message": "Unable to delete object."';
    echo '}';
}
?>