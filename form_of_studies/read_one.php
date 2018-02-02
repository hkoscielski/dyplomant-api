<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

include_once '../config/database.php';
include_once '../objects/form_of_studies.php';

$database = new Database();
$db = $database->getConnection();
 
$form_of_studies = new FormOfStudies($db);

$form_of_studies->id_form = isset($_GET['id_form']) ? $_GET['id_form'] : die();

$form_of_studies->readOne();

$form_of_studies_arr = array(
    "id_form" =>  $form_of_studies->id_form,
    "form_name" => $form_of_studies->form_name      
);

print_r(json_encode($form_of_studies_arr));
?>