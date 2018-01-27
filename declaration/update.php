<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/declaration.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare declaration object
$declaration = new Declaration($db);
 
// get id of declaration to be edited
$data = json_decode(file_get_contents("php://input"));
 
// set ID property of declaration to be edited
$declaration->id_declaration = $data->id_declaration;
 
// set declaration property values
$declaration->id_subject = $data->id_subject;
$declaration->id_graduate = $data->id_graduate;
$declaration->language = $data->language;
$declaration->purpose_range = $data->purpose_range;
$declaration->short_desc = $data->short_desc;
$declaration->submit_date = $data->submit_date;
$declaration->supervisor_sign_date = $data->supervisor_sign_date;
$declaration->id_declaration_status = $data->id_declaration_status;
 
// update the declaration
if($declaration->update()){
    echo '{';
        echo '"message": "Declaration was updated."';
    echo '}';
}
 
// if unable to update the declaration, tell the user
else{
    echo '{';
        echo '"message": "Unable to update declaration."';
    echo '}';
}
?>