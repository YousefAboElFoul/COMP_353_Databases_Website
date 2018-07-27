<?php
//echo "working";
// Initialize the session
session_start();
require_once '../../config.php';

$uname = $_SESSION['username'];
// echo $uname;
//    // Unset all of the session variables
//    //$_SESSION = array();
$sql = "UPDATE company_worker SET contract_type_id = 4 WHERE user_name = ?";
if($stmt = mysqli_prepare($conn, $sql)) {
    //echo "working";
    mysqli_stmt_bind_param($stmt, "s", $param_id);
    $param_id = $uname;
    //echo $param_id;
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