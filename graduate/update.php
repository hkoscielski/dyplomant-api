<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../objects/graduate.php';

$database = new Database();
$db = $database->getConnection();

$graduate = new Graduate($db);

$data = json_decode(file_get_contents("php://input"));

$graduate->id_graduate = $data->id_graduate;
 
$graduate->id_subject = $data->id_subject;

if($graduate->update()){
    print_r(json_encode(array("success" => "true", "message" => "Graduate was updated")));
}

else{
    print_r(json_encode(array("success" => "false", "message" => "Graduate was not updated")));
}
?>