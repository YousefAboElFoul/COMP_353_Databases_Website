<?php
// Include config file
session_start();
require_once '../config.php';
// If session variable is not set it will redirect to login page
//if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
//    header("location: login.php");
//    exit;
//}
//echo "post id: " . $_GET["id"];
//$contract_id = 0;
// Processing form data when form is submitted
if(isset($_GET["id"]) && !empty($_GET["id"])) {
// Get hidden input value
    $contract_id = $_GET["id"];
    echo "Id is: " . $contract_id;
} else {
    echo "Can't get contract_id";
}
// Processing form data when form is submitted
if(empty($_GET["id"])) {
    echo "EMPTY";
}
// Processing form data when form is submitted
if(!isset($_GET["id"]) ) {
    echo "NOT SET";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Assigned Managers</title>
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
<h4>Contract:</h4>

<div>
    <?php
    // THIS TABLE IS MISSING VALUES
    echo "<table class='table table-bordered table-striped'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>Contract Id</th>";
    echo "<th>Responsible ID</th>";
    echo "<th>ACV</th>";
    echo "<th>Initial Amount</th>";
    echo "<th>Contract Type</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    ////////////////////////////
    // Attempt select query execution
    $sql = "SELECT * FROM Contract WHERE id=?";
    $contract_type_id = 0;
    if($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $param1);
        $param1 = $contract_id;
        if(mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            if(mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_assoc($result);
                $contract_type_id = $row['contract_type'];
                //echo "working: " . $row['id'];
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['responsible_id'] . "</td>";
                echo "<td>" . $row['acv'] . "</td>";
                echo "<td>" . $row['initial_amount'] . "</td>";
                echo "<td>". $row['contract_type'] . "</td>";
                echo "</tr>";
            }
        }
    }
    /// ////////////////////////////////////////////////////////
    echo "</tbody>";
    echo "</table>";
    echo "<h3>Managers on Contract</h3>";
    echo "<table class='table table-bordered table-striped'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>Manager Id</th>";
    echo "<th>Name</th>";
    echo "</thead>";
    echo "<tbody>";
    //////////////////////////////////////////////////////////
    $sql = "SELECT Manager.id, Manager.name FROM Contract_Manager INNER JOIN 
            Manager ON 
            Contract_Manager.manager_id = Manager.id WHERE
            Contract_Manager.contract_id = ?";
    if($stmt = mysqli_prepare($conn, $sql)) {
       // echo "working";
        mysqli_stmt_bind_param($stmt, "i", $param1);
        $param1 = $contract_id;
        if(mysqli_stmt_execute($stmt)) {
         //   echo "working1";
            $result = mysqli_stmt_get_result($stmt);
            if(mysqli_num_rows($result) > 0) {
            //    echo "working2";

                while($row = mysqli_fetch_array($result)){
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "</tr>";
                }
            }
        }
    }
    /////////////////////////////////////////////////////////
    echo "</tbody>";
    echo "</table>";

    ?>

</div>
</body>
</html>
