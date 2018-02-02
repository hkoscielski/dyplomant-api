<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/form_of_studies.php';

$database = new Database();
$db = $database->getConnection();

$form_of_studies = new FormOfStudies($db);

$stmt = $form_of_studies->read();
$num = $stmt->rowCount();

if($num>0) {

    $form_of_studies_arr=array();
    $form_of_studies_arr["records"]=array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        extract($row);
 
        $form_of_studies_item=array(
            "id_form" => $id_form,
            "form_name" => $form_name            
        );
 
        array_push($form_of_studies_arr["records"], $form_of_studies_item);
    }
 
    echo json_encode($form_of_studies_arr);
}
 
else {
    echo json_encode(
        array("message" => "No form of studies found.")
    );
}
?>