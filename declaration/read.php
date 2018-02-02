<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/declaration.php';
 
$database = new Database();
$db = $database->getConnection();

$declaration = new Declaration($db);

$stmt = $declaration->read();
$num = $stmt->rowCount();

if($num>0) {
 
    $declarations_arr=array();
    $declarations_arr["declarations"]=array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
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