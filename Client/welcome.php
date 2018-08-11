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
                    <h2 class="pull-left">Your Contracts</h2>

                </div>
                <?php
             //   echo "1: TEST  HERE";
			  
              			  require_once '../config.php'; 
							$client_id=0;
                $sql = "SELECT id FROM Account WHERE username=?";
                if($stmt = mysqli_prepare($conn, $sql)){
                    mysqli_stmt_bind_param($stmt,  "s",  $param1);
                    $param1 = $_SESSION['username'];
                    if(mysqli_stmt_execute($stmt)) {
                        $result = mysqli_stmt_get_result($stmt);
                        if(mysqli_num_rows($result) == 1){
                            $first_row = mysqli_fetch_assoc($result);
                            $client_id = $first_row['id'];
							
                        }
                    }
                }
               
				
                $sql = "SELECT * FROM Contract WHERE client_id = ?";
                if($stmt = mysqli_prepare($conn, $sql)) {
                    mysqli_stmt_bind_param($stmt, "s", $param1);
                    $param1 = $client_id;
                    if(mysqli_stmt_execute($stmt)) {
                        $result = mysqli_stmt_get_result($stmt);
                        if(mysqli_num_rows($result) > 0){
                           
                            echo "<table class='table table-bordered table-striped'>";
                            echo "<thead>";
                            echo "<tr>";
                            echo "<th>Contract Id</th>";
                            echo "<th>Responsible ID</th>";
                            echo "<th>ACV</th>";
                            echo "<th>Initial Amount</th>";
                            echo "<th>Start Date</th>";
							echo "<th>Service_type</th>";
							echo "<th>Contract type</th>";
							echo "<th>Satisfaction rating</th>";
                            echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                            while($row = mysqli_fetch_array($result)){
                           /*     $contract_type = "error";
                                $contract_query = "SELECT name FROM contract_type WHERE id = ". $row['contract_type_id'];
                                if($contract_result = mysqli_query($conn, $contract_query)) {
                                    $contract_type_rows = mysqli_fetch_array($contract_result);
                                    //$contract_type_row_zero = $contract_type_rows[0];
                                    $contract_type = $contract_type_rows['name'];
                                }*/
                                echo "<tr>";
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td>" . $row['responsible_id'] . "</td>";
                                echo "<td>" . $row['acv'] . "</td>";
                                echo "<td>" . $row['initial_amount'] . "</td>";
                                echo "<td>". $row['start_date'] . "</td>";
				echo "<td>". $row['service_type'] . "</td>";
				echo "<td>". $row['contract_type'] . "</td>";
				echo "<td>". $row['client_satisfaction'] . "</td>";
                                echo "<td>";
				echo "<a href='satisfaction.php?id=". $row['id'] ."' title='Update Your satisfaction' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
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

<p><a href=<?php echo  "logout.php" ?> class="btn btn-danger">Sign Out of Your Account</a></p>
<p>Want to view the Manager's Rating <a href="manager_rating.php">Click here</a>.</p>
</body>
</html>
