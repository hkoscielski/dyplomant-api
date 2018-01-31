<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/declaration.php';
 
// instantiate database and declaration object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$declaration = new Declaration($db);
 
// query products
$stmt = $declaration->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0) {
 
    // declarations array
    $declarations_arr=array();
    $declarations_arr["declarations"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $declaration_item=array(
            "id_declaration" => $id_declaration,
            "id_subject" => $id_subject,
            "id_graduate" => $id_graduate,
            "language" => $language,
            "purpose_range" => $purpose_range,
            "short_desc" => $short_desc,
            "submit_date" => $submit_date,
            "supervisor_sign_date" => $supervisor_sign_date,
            "id_declaration_status" => $id_declaration_status
        );
 
        array_push($declarations_arr["declarations"], $declaration_item);
    }
 
    echo json_encode($declarations_arr);
}
 
else {
    echo json_encode(
        array("message" => "No declarations found.")
    );
}
?>