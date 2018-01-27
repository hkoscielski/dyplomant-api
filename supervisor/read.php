<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/supervisor.php';
 
// instantiate database and supervisor object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$supervisor = new Supervisor($db);
 
// query supervisors
$stmt = $supervisor->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0) {
 
    // supervisors array
    $supervisor_arr=array();
    $supervisor_arr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $supervisor_item=array(
            "id_supervisor" => $id_supervisor,
            "academic_title" => $academic_title,
            "name" => $name,
            "surname" => $surname,
            "id_department" => $id_department           
        );
 
        array_push($supervisor_arr["records"], $supervisor_item);
    }
 
    echo json_encode($supervisor_arr);
}
 
else {
    echo json_encode(
        array("message" => "No supervisors found.")
    );
}
?>