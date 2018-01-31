<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/department.php';
 
// instantiate database and department object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$department = new Department($db);
 
// query department
$stmt = $department->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0) {
 
    // department array
    $department_arr=array();
    $department_arr["departments"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $department_item=array(
            "id_department" => $id_department,
            "department_name" => $department_name            
        );
 
        array_push($department_arr["departments"], $department_item);
    }
 
    echo json_encode($department_arr);
}
 
else {
    echo json_encode(
        array("message" => "No department found.")
    );
}
?>