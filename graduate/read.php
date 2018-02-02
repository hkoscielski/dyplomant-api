<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/graduate.php';

$database = new Database();
$db = $database->getConnection();

$graduate = new Graduate($db);

$stmt = $graduate->read();
$num = $stmt->rowCount();

if($num>0) {

    $graduates_arr=array();
    $graduates_arr["graduates"]=array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        extract($row);
 
        $graduate_item=array(
            "id_graduate" => $id_graduate,
            "id_subject" => $id_subject,
            "name" => $name,
            "surname" => $surname,
            "student_no" => $student_no,
            "speciality" => $speciality,
            "id_form" => $id_form,
            "year_of_studies" => $year_of_studies            
        );
 
        array_push($graduates_arr["graduates"], $graduate_item);
    }
 
    echo json_encode($graduates_arr);
}
 
else {
    echo json_encode(
        array("message" => "No graduates found.")
    );
}
?>