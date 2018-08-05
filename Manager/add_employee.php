<?php
session_start();
require_once '../config.php';

// If session variable is not set it will redirect to login page
//if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
//    header("location: login.php");
//    exit;
//}

//echo "post id: " . $_GET["id"];

// Processing form data when form is submitted
if(isset($_GET["contract_type_id"]) && !empty($_GET["contract_type_id"])) {
// Get hidden input value
    $contract_type_id = $_GET["contract_type_id"];
    echo "Id is: " . $contract_type_id;
} else {
    echo "Can't get contract_type_id";
}

// Processing form data when form is submitted
if(isset($_GET["contract_id"]) && !empty($_GET["contract_id"])) {
// Get hidden input value
    $contract_id = $_GET["contract_id"];
    //echo "Id is: " . $contract_type_id;
} else {
    echo "Can't get contract_id";
    echo "type: " . gettype($_GET["contract_id"]);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
    <script
        src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
<h3>Employees available to work on this contract</h3>
<div>
    <?php


    // THIS TABLE IS MISSING VALUES
    echo "<table class='table table-bordered table-striped'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>Employee Id</th>";
        echo "<th>Employee Name</th>";
        echo "<th>Preferred Contract Type</th>";
        echo "<th></th>";


    echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
////////////////////////////
            // Attempt select query execution
    $sql = "SELECT Employee.id, Employee.name, Contract_type.name FROM Employee INNER JOIN
            Contract_type ON Contract_type.id = Employee.contract_type WHERE Employee.contract_type=?";
    //$sql = "SELECT * FROM company_worker";

    if($stmt = mysqli_prepare($conn, $sql)) {
        echo "working prepared";
        mysqli_stmt_bind_param($stmt, "i", $param1);
        $param1 = $contract_type_id;
        if(mysqli_stmt_execute($stmt)) {
            echo "working2";
            $result = mysqli_stmt_get_result($stmt);
            while($row = mysqli_fetch_array($result)){
                echo "working3";
                //echo $row;


                echo "<td>" . $row[0] . "</td>";
                echo "<td>" . $row[1] . "</td>";
                echo "<td>" . $row[2] . "</td>";
                // echo "<td>" . $row['manager_id' ] . "</td>";
                echo "<td>";
                echo  "<p><a href=" . $base_url . "Manager/employee_added.php?emp_id=". $row['id'].
                        "&contract_id=". $contract_id . " class='btn btn-success'>Add</a></p>";
                echo "</td>";
                echo "</tr>";
            }
        }
    }

    //echo "<a href='add_employee.php?contract_type_id=". $contract_type_id . "' class= btn btn-success pull-right>Add New Employee</a";
    // Free result set
   // mysqli_free_result($result);
    ?>
</div>
</body>
</html>