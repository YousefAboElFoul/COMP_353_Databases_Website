<?php
// Initialize the session
session_start();

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
    <h1> Welcome to our site.</h1>
</div>

<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header clearfix">
                    <h2 class="pull-left">Your Contracts</h2>

                </div>
                <?php

                // I SHOULD ACTUALLY HAVE THE LIST OF CONTRACTS FOR THIS MANAGER HERE
                // WHERE EDITING --> NEW PAGE THAT SHOWS THE CONTRACT DETAILS AND THE LIST OF
                // EMPLOYEES WORKING ON IT WHERE MANAGER CAN ADD AN EMPLOYEE IF THEIR PREFERANCE MATCHES
                // THIS CONTRACT
                // Include config file
                require_once '../config.php';
                //$manager_id = 0;

                $sql = "SELECT 
                          Contract.id AS Con_id, 
                          Contract.client_id, 
                          Contract.responsible_id , 
                          Contract.acv , 
                          Contract.initial_amount ,
                          Contract.start_date ,
                          Contract.service_type ,
                          Contract.contract_type ,
                          Contract.client_satisfaction FROM Manager INNER JOIN ContractManager ON 
                          Manager.id = ContractManager.manager_id 
                          INNER JOIN Contract ON Contract.id = ContractManager.contract_id WHERE 
                          ContractManager.manager_id = ?
                        ";


                if($stmt = mysqli_prepare($conn, $sql)) {
                    mysqli_stmt_bind_param($stmt, "i", $param1);
                    $param1 = $manager_id;
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
                            echo "<th></th>";

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
                                echo "<td>" . $row['Con_id'] . "</td>";
                                echo "<td>" . $row['responsible_id'] . "</td>";
                                echo "<td>" . $row['acv'] . "</td>";
                                echo "<td>" . $row['initial_amount'] . "</td>";

                                echo "<td>". $row['contract_type'] . "</td>";
                                echo "<td>";
                                echo "<a href='update.php?id=". $row['Con_id'] ."' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
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

<p><a href=<?php echo $base_url . "Manager/logout.php" ?> class="btn btn-danger">Sign Out of Your Account</a></p>
</body>
</html>