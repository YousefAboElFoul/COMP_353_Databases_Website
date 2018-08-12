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
</div>

<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header clearfix">
                    <h2 class="pull-left"> Premium Contract</h2>

                </div>
                <?php

                require_once '../config.php';
				
                // Attempt select query execution
                $sql =  "SELECT name,contract.id,Client.city,client_satisfaction FROM Contract,Client WHERE contract.client_id= client.id AND contract_type='1' ORDER BY client_satisfaction DESC LIMIT 1 "  ;
                if($stmt = mysqli_prepare($conn, $sql)) {
                    if(mysqli_stmt_execute($stmt)) {
                        $result = mysqli_stmt_get_result($stmt);
                        if(mysqli_num_rows($result) > 0  && $result){

                            // THIS TABLE IS MISSING VALUES
                            echo "<table class='table table-bordered table-striped'>";
                            echo "<thead>";
                            echo "<tr>";
							echo "<th>Client</th>";
							echo "<th>City</th>";
                            echo "<th>Contract ID</th>";
                            echo "<th> Client satisfaction</th>";

                            echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
						while($row = mysqli_fetch_array($result))
						{
                                echo "<tr>";
								
                                echo "<td>" . $row['name'] . "</td>";
								echo "<td>" . $row['city'] . "</td>";	
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td>" . $row['client_satisfaction'] . "</td>";

                                echo "</tr>";
                            }
                            echo "</tbody>";
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);

                        }else{
                       echo "<p class='lead'><em>No Premium Contracts were found.</em></p>";
                        }
                    }
                }	

                ?>
            </div>
        </div>
    </div>
</div>


<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header clearfix">
                    <h2 class="pull-left"> Diamond Contract</h2>

                </div>
                <?php

                require_once '../config.php';
				
                // Attempt select query execution
                $sql =  "SELECT name,contract.id,client_satisfaction FROM Contract,Client WHERE contract.client_id= client.id AND contract_type='2' ORDER BY client_satisfaction DESC LIMIT 1"  ;
                if($stmt = mysqli_prepare($conn, $sql)) {
                    if(mysqli_stmt_execute($stmt)) {
                        $result = mysqli_stmt_get_result($stmt);
                        if(mysqli_num_rows($result) > 0  && $result){

                            // THIS TABLE IS MISSING VALUES
                            echo "<table class='table table-bordered table-striped'>";
                            echo "<thead>";
                            echo "<tr>";
							 echo "<th>Client</th>";
                            echo "<th>Contract ID</th>";
                            echo "<th> Client satisfaction</th>";

                            echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
						while($row = mysqli_fetch_array($result))
						{
                                echo "<tr>";
								
                                echo "<td>" . $row['name'] . "</td>";
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td>" . $row['client_satisfaction'] . "</td>";

                                echo "</tr>";
                            }
                            echo "</tbody>";
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);

                        }else{
                            echo "<p class='lead'><em>No Diamond contracts were found.</em></p>";
                        }
                    }
                }
                
				

                ?>
            </div>
        </div>
    </div>
</div>

<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header clearfix">
                    <h2 class="pull-left"> Gold Contract</h2>

                </div>
                <?php

                require_once '../config.php';
				
                // Attempt select query execution
                $sql =  "SELECT name,contract.id,client_satisfaction FROM Contract,Client WHERE contract.client_id= client.id AND contract_type='3' ORDER BY client_satisfaction DESC LIMIT 1"  ;
                 if($stmt = mysqli_prepare($conn, $sql)) {
                    if(mysqli_stmt_execute($stmt)) {
                        $result = mysqli_stmt_get_result($stmt);
                        if(mysqli_num_rows($result) > 0  && $result){

                            // THIS TABLE IS MISSING VALUES
                            echo "<table class='table table-bordered table-striped'>";
                            echo "<thead>";
                            echo "<tr>";
							 echo "<th>Client</th>";
                            echo "<th>Contract ID</th>";
                            echo "<th> Client satisfaction</th>";

                            echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
						while($row = mysqli_fetch_array($result))
						{
                                echo "<tr>";
								
                                echo "<td>" . $row['name'] . "</td>";
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td>" . $row['client_satisfaction'] . "</td>";

                                echo "</tr>";
                            }
                            echo "</tbody>";
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);

                        }else{
                            echo "<p class='lead'><em>No Gold contract were found.</em></p>";
                        }
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>

<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header clearfix">
                    <h2 class="pull-left"> Silver Contract</h2>

                </div>
                <?php

                require_once '../config.php';
				
                // Attempt select query execution
                $sql = "SELECT name,contract.id,client_satisfaction FROM Contract,Client WHERE contract.client_id= client.id AND contract_type='4' ORDER BY client_satisfaction DESC LIMIT 1";
       if($stmt = mysqli_prepare($conn, $sql)) {
                    if(mysqli_stmt_execute($stmt)) {
                        $result = mysqli_stmt_get_result($stmt);
                        if(mysqli_num_rows($result) > 0  && $result){

                            // THIS TABLE IS MISSING VALUES
                            echo "<table class='table table-bordered table-striped'>";
                            echo "<thead>";
                            echo "<tr>";
							 echo "<th>Client</th>";
                            echo "<th>Contract ID</th>";
                            echo "<th> Client satisfaction</th>";

                            echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
						while($row = mysqli_fetch_array($result))
						{
                                echo "<tr>";
								
                                echo "<td>" . $row['name'] . "</td>";
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td>" . $row['client_satisfaction'] . "</td>";

                                echo "</tr>";
                            }
                            echo "</tbody>";
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);

                        }else{
                            echo "<p class='lead'><em>No Silver contracts were found.</em></p>";
                        }
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
