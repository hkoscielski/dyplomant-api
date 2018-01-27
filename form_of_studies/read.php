<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/form_of_studies.php';
 
// instantiate database and form of studies object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$form_of_studies = new FormOfStudies($db);
 
// query products
$stmt = $form_of_studies->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0) {
 
    // form of studies array
    $form_of_studies_arr=array();
    $form_of_studies_arr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // extract row
        // this will make $row['name'] to
        // just $name only
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