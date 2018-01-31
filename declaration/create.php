<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../config/database.php';
 
// instantiate declaration object
include_once '../objects/declaration.php';
 
$database = new Database();
$db = $database->getConnection();
 
$declaration = new Declaration($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"), true);

// set declaration property values
$declaration->id_declaration = $data['id_declaration'];
$declaration->id_subject = $data['id_subject'];
$declaration->id_graduate = $data['id_graduate'];
$declaration->language = $data['language'];
$declaration->purpose_range = $data['purpose_range'];
$declaration->short_desc = $data['short_desc'];
$declaration->submit_date = isset($data['submit_date']) ? $data['submit_date'] : null;
$declaration->supervisor_sign_date = isset($data['supervisor_sign_date']) ? $data['supervisor_sign_date'] : null;
$declaration->id_declaration_status = $data['id_declaration_status'];

// create the declaration
if($declaration->create()){
   print_r(json_encode(
        array("success" => "true", "message" => "Declaration was created.")
    ));
}
 
// if unable to create the declaration, tell the user
else{
    print_r(json_encode(
        array("success" => "false", "message" => "Unable to create declaration.")
    ));
}
?>