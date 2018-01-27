<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/graduate.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare graduate object
$graduate = new Graduate($db);
 
// get id of graduate to be edited
$data = json_decode(file_get_contents("php://input"));
 
// set ID property of graduate to be edited
$graduate->id_graduate = $data->id_graduate;
 
// set graduate property values
$graduate->id_subject = $data->id_subject;
 
// update graduate
if($graduate->update()){
    echo '{';
        echo '"message": "Graduate was updated."';
    echo '}';
}
 
// if unable to update graduate, tell the user
else{
    echo '{';
        echo '"message": "Unable to update graduate."';
    echo '}';
}
?>