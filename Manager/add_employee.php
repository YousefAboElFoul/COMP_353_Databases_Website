<?php
// Initialize the session
session_start();
require_once '../config.php';


// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
    header("location: login.php");
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
<div class="page-header">
    <h1>Hi, <b><?php echo htmlspecialchars($_SESSION['username']); ?></b>. Welcome to our site.</h1>
</div>

<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header clearfix">
                    <h2 class="pull-left">All Gold Contracts</h2>

                </div>
                <?php

                //$manager_id = 0;

                $sql = "SELECT 
                          Contract.id AS con_id, 
                          Contract.client_id, 
                          Contract.responsible_id , 
                          Contract.acv , 
                          Contract.initial_amount ,
                          Contract.start_date ,
                          Contract.service_type ,
                          Contract.contract_type ,
                          Contract.client_satisfaction,
                          Contract_type.name AS con_type_name FROM Contract INNER JOIN Contract_type ON 
                          Contract.contract_type = Contract_type.id
                          WHERE Contract.contract_type = ?
                        ";


                if($stmt = mysqli_prepare($conn, $sql)) {
                    mysqli_stmt_bind_param($stmt, "i", $param1);
                    $param1 = 3;  // Gold is 3
                    if(mysqli_stmt_execute($stmt)) {
                        $result = mysqli_stmt_get_result($stmt);
                        if(mysqli_num_rows($result) > 0){

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
                            while($row = mysqli_fetch_array($result)){
                                $contract_type = "error";
                                $contract_query = "SELECT name FROM contract_type WHERE id = ". $row['contract_type_id'];
                                if($contract_result = mysqli_query($conn, $contract_query)) {
                                    $contract_type_rows = mysqli_fetch_array($contract_result);
                                    //$contract_type_row_zero = $contract_type_rows[0];
                                    $contract_type = $contract_type_rows['name'];
                                }
                                echo "<tr>";
                                echo "<td>" . $row['con_id'] . "</td>";
                                echo "<td>" . $row['responsible_id'] . "</td>";
                                echo "<td>" . $row['acv'] . "</td>";
                                echo "<td>" . $row['initial_amount'] . "</td>";

                                echo "<td>". $row['con_type_name'] . "</td>";
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

<p><a href=<?php echo $base_url . "Manager/logout.php" ?> class="btn btn-danger">Sign Out of Your Account</a></p>
</body>
</html>
