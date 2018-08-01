<?php
//echo "working";
// Initialize the session
session_start();
require_once '../../config.php';

// If session variable is not set it will redirect to login page
if(!isset($_SESSION['employee_id']) || empty($_SESSION['employee_id'])){
    echo "Something went wrong";
} else {
    $employee_id = $_SESSION['employee_id'];
    //echo "employee_id: " . $employee_id;
}


$uname = $_SESSION['username'];

$sql = "UPDATE Employee SET contract_type = 3 WHERE id=" . $employee_id;
if($stmt = mysqli_prepare($conn, $sql)) {
    //echo "working";
    if(mysqli_stmt_execute($stmt)){
        //echo "working3";
        header("location: ../welcome.php");
        exit();
    } else {
        echo "Something went wrong";
    }
} else {
    echo "mysqli_prepare failed";
}

// Close statement
mysqli_stmt_close($stmt);

// Close connection
mysqli_close($conn);
?>