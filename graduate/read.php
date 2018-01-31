<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/graduate.php';
 
// instantiate database and graduate object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$graduate = new Graduate($db);
 
// query products
$stmt = $graduate->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0) {
 
    // graduates array
    $graduates_arr=array();
    $graduates_arr["graduates"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // extract row
        // this will make $row['name'] to
        // just $name only
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