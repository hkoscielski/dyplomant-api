<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/subject_status.php';
 
// instantiate database and subject status object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$subject_status = new SubjectStatus($db);
 
// query subject status
$stmt = $subject_status->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0) {
 
    // subject status array
    $subject_status_arr=array();
    $subject_status_arr["subject_statuses"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $subject_status_item=array(
            "id_subject_status" => $id_subject_status,
            "status_name" => $status_name            
        );
 
        array_push($subject_status_arr["subject_statuses"], $subject_status_item);
    }
 
    echo json_encode($subject_status_arr);
}
 
else {
    echo json_encode(
        array("message" => "No subject status found.")
    );
}
?>