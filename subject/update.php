<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/subject.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare subject object
$subject = new Subject($db);
 
// get id of declaration to be edited
$data = json_decode(file_get_contents("php://input"));
 
// set ID property of subjects to be edited
$subjects->id_subjects = $data->id_subject;
 
// set subject property values
$subject->id_supervisor = $data->id_supervisor;
$declaration->subject_pl = $data->subject_pl;
$declaration->subject_en = $data->subject_en;
$declaration->taken_up = $data->taken_up;
$declaration->graduates_limit = $data->graduates_limit;
$declaration->id_subject_status = $data->id_subject_status;
 
// update the subject
if($subject->update()){
    echo '{';
        echo '"message": "Subject was updated."';
    echo '}';
}
 
// if unable to update the subject, tell the user
else{
    echo '{';
        echo '"message": "Unable to update subject."';
    echo '}';
}
?>