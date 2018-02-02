<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/form_of_studies.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare form of studies object
$form_of_studies = new FormOfStudies($db);
 
// set name property of form of studies to be edited
$form_of_studies->id_form = isset($_GET['id_form']) ? $_GET['id_form'] : die();
 
// read the details of form of studies to be edited
$form_of_studies->readOne();
 
// create array
$form_of_studies_arr = array(
    "id_form" =>  $form_of_studies->id_form,
    "form_name" => $form_of_studies->form_name      
);
 
// make it json format
print_r(json_encode($form_of_studies_arr));
?>