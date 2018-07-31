<?php
session_start();
require_once '../config.php';

// Processing form data when form is submitted
if(isset($_GET["contract_id"]) && !empty($_GET["contract_id"])) {
// Get hidden input value
    $contract_id = $_GET["contract_id"];
    //echo "Id is: " . $contract_type_id;
} else {
    echo "Can't get contract_type_id";
}

// Processing form data when form is submitted
if(isset($_GET["emp_id"]) && !empty($_GET["emp_id"])) {
// Get hidden input value
    $employee_id = $_GET["emp_id"];
    //echo "Id is: " . $contract_type_id;
} else {
//    echo "Can't get contract_id";
//    echo "type: " . gettype($_GET["emp_id"]);
}

$sql = "DELETE FROM contract_worker WHERE company_worker_id=? AND contract_id=?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ii", $param1,$param2);
$param1 = $employee_id;
$param2 = $contract_id;
if( mysqli_stmt_execute($stmt)) {
    header("location: " . $base_url . "Manager/welcome.php");
    exit;
} else {
    echo "Something went wrong";
}

?>