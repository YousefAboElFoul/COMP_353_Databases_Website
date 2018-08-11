<?php
// Initialize the session
session_start();
require_once '../config.php';


// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
    header("location: ". $base_url . "Manager/login.php");
    exit;
}

//if(isset($_SESSION['manager_id']) && !empty($_SESSION['manager_id'])) {
//    $manager_id = $_SESSION['manager_id'];
//    //echo "manager_id = ". $manager_id;
//} else {
//    echo "No manager id";
//}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>

<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header clearfix">
                    <h2 class="pull-left">Contracts From Last 10 Days by Sales Associate </h2>

                </div>
                <?php

                //$manager_id = 0;

                $sql = "SELECT * FROM SalesAssociate";


                if($stmt = mysqli_prepare($conn, $sql)) {
                    //mysqli_stmt_bind_param($stmt, "i", $param1);
                    //$param1 = 3;  // Gold is 3
                    if(mysqli_stmt_execute($stmt)) {
                        $result = mysqli_stmt_get_result($stmt);
                        if(mysqli_num_rows($result) > 0){

                            // THIS TABLE IS MISSING VALUES
                            echo "<table class='table table-bordered table-striped'>";
                            echo "<thead>";
                            echo "<tr>";
                            echo "<th>Sales Associate</th>";
                            echo "<th>View Contracts</th>";
                            echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                            while($row = mysqli_fetch_array($result)){
                                echo "<tr>";
                                echo "<td>" . $row['name'] . "</td>";
                                echo "<td>";
                                echo "<a href='view.php?sales_id=". $row['id'] ."&sales_name=". $row['name'] . "' title='View Contracts' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                                echo "</td>";
                                echo "</tr>";
                            }
                            echo "</tbody>";
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);

                        }else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else {
                        echo "Could not executd sql statement";
                    }
                }

                // Close connection
                mysqli_close($conn);
                ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>
