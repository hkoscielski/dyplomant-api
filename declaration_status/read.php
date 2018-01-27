<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/declaration_status.php';
 
// instantiate database and declaration status object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$declaration_status = new DeclarationStatus($db);
 
// query declaration status
$stmt = $declaration_status->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0) {
 
    // form of studies array
    $declaration_status_arr=array();
    $declaration_status_arr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $declaration_status_item=array(
            "id_declaration_status" => $id_declaration_status,
            "status_name" => $status_name            
        );
 
        array_push($declaration_status_arr["records"], $declaration_status_item);
    }
 
    echo json_encode($declaration_status_arr);
}
 
else {
    echo json_encode(
        array("message" => "No declaration status found.")
    );
}
?>