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
                    <h2 class="pull-left">Number of Premium contracts delivered in more than 10 business days having more than 35 employees with “Silver Employee Plan”</h2>

                </div>
                <?php

                require_once '../config.php';
				
                // Attempt select query execution
                $sql ="SELECT( SELECT COUNT(*) FROM Contract AS DBT
WHERE((SELECT COUNT(*) FROM Contract_Employee,Employee where Contract_Employee.employee_id=Employee.id AND Employee.employee_plan_id='2' AND 
DBT.id=Contract_Employee.contract_id)>35 AND DATEDIFF(DBT.final_deliverable,DBT.start_date)>10)) as Count;";

                if($stmt = mysqli_prepare($conn, $sql)) {
                    if(mysqli_stmt_execute($stmt)) {
                        $result = mysqli_stmt_get_result($stmt);
                        if(mysqli_num_rows($result) > 0){

                            // THIS TABLE IS MISSING VALUES
                            echo "<table class='table table-bordered table-striped'>";
                            echo "<thead>";
                            echo "<tr>";
                            echo "<th>Premium Contracts</th>";
                            echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
						while($row = mysqli_fetch_array($result))
						{
                                echo "<tr>";
                                echo "<td>" . $row['Count'] . "</td>";
                                echo "</tr>";
                            }
                            echo "</tbody>";
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);

                        }else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
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