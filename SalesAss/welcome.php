<?php
// Initialize the session
session_start();

// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
    header("location: login.php");
    exit;
}
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
                    <h2 class="pull-left">Contracts</h2>

                </div>
                <?php


                // Include config file
                require_once '../config.php';
        
                // Attempt select query execution
                $sql = "SELECT * FROM contract";
                if($stmt = mysqli_prepare($conn, $sql)) {
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
                               
                                echo "<tr>";
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td>" . $row['responsible_id'] . "</td>";
                                echo "<td>" . $row['acv'] . "</td>";
                                echo "<td>" . $row['initial_amount'] . "</td>";
                                echo "<td>". $row['contract_type'] . "</td>";
                                echo "<td>";
								echo "<a href='managers.php?id=". $row['id'] ."' title='View Managers' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
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
                    }
                }

                // Close connection
                mysqli_close($conn);
                ?>
            </div>
			
			<div>
			<a href="register.php" class="btn btn-success pull-right">Add New Client</a>
            </div>
        </div>
    </div>
</div>

<p><a href=<?php echo $base_url . "SalesAss/logout.php" ?> class="btn btn-danger">Sign Out of Your Account</a></p>
</body>
</html>