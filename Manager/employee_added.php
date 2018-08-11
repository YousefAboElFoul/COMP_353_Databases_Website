<?php
// Initialize the session
session_start();
require_once "../config.php";



// Processing form data when form is submitted
if(isset($_GET["emp_id"]) && !empty($_GET["emp_id"])) {
// Get hidden input value
    $employee_id = $_GET["emp_id"];
    echo "Employee Id is: " . $employee_id;
} else {
    echo "Can't get contract_id";
}

// Processing form data when form is submitted
if(isset($_GET["contract_id"]) && !empty($_GET["contract_id"])) {
// Get hidden input value
    $contract_id = $_GET["contract_id"];
    echo "Contract Id is: " . $contract_id;
} else {
    echo "Can't get contract_id";
}

$sql = "SELECT * FROM Contract_Employee WHERE employee_id =? AND contract_id = ?";
if($stmt = mysqli_prepare($conn, $sql)) {
    mysqli_stmt_bind_param($stmt, "ii", $param1, $param2);
    $param1 = $employee_id;
    $param2 = $contract_id;

    if (mysqli_stmt_execute($stmt)) {
        $result = mysqli_stmt_get_result($stmt);
        if(mysqli_num_rows($result) > 0) {
            // Redirect to welcome page
            header("location: " . $base_url . "Manager/welcome.php");
            exit;
        }

    }
}

$sql = "INSERT INTO Contract_Employee(employee_id, contract_id, hours_worked) VALUES (?, ?, ?)";
if($stmt = mysqli_prepare($conn, $sql) ) {
    mysqli_stmt_bind_param($stmt, "iii", $param1, $param2, $param3);
    $param1 = $employee_id;
    $param2 = $contract_id;
    $pos = array_rand($hours_worked);
    $param3 = 30 + $hours_worked[$pos];
    //echo "param3: ". $param3;

    if (mysqli_stmt_execute($stmt)) {
        // Redirect to welcome page
        echo "Employee added to contract";
        header("location: " . $base_url . "Manager/welcome.php");
        exit;
    } else {
        echo "Could not add Employee to contract";
    }
}

// Redirect to login page
//header("location: " . $base_url . "Manager/welcome.php");
//exit;
?>
