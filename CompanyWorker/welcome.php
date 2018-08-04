<?php
// Initialize the session
session_start();

// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
    header("location: login.php");
    exit;
}

// If session variable is not set it will redirect to login page
if(isset($_SESSION['employee_id']) ){
    echo "employee_id: " . $_SESSION['employee_id'];

} else {
    echo "employee_id: no set";

}

if( empty($_SESSION['employee_id'])){
    echo "employee_id: empyt";
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
                    <h2 class="pull-left">Company Worker Details</h2>
                </div>
                <?php
                // Include config file
                require_once '../config.php';
                // Attempt select query execution
                $sql = "SELECT * FROM Employee INNER JOIN Account ON user_id = Account.id ";
                if($result = mysqli_query($conn, $sql)){
                    //echo "working";
                    if(mysqli_num_rows($result) > 0){
                        echo "<table class='table table-bordered table-striped'>";
                        echo "<thead>";
                        echo "<tr>";
                        echo "<th>#</th>";
                        echo "<th>Name</th>";
                        echo "<th>Username</th>";
                        echo "<th>Password</th>";
                        echo "<th>Contract Type</th>";
                        echo "<th>Action</th>";
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";
                        while($row = mysqli_fetch_array($result)){
                            $contract_type = "error";
                            //echo "working2";

                            $contract_query = "SELECT name FROM Contract_type WHERE id = ". $row['contract_type'];
                            if($contract_result = mysqli_query($conn, $contract_query)) {
                               // echo "working3";

                                $contract_type_rows = mysqli_fetch_array($contract_result);
                                //$contract_type_row_zero = $contract_type_rows[0];
                                $contract_type = $contract_type_rows['name'];
                            }
                            if($_SESSION['username'] ==$row['username']){
                                echo "<tr>";
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td>" . $row['name'] . "</td>";
                                echo "<td>" . $row['username'] . "</td>";
                                echo "<td>" . $row['password'] . "</td>";
                                echo "<td>". $contract_type . "</td>";
                                echo "<td>";
                                echo "<a href='#'><span class='glyphicon glyphicon-eye-open'></span></a>";
                                echo "<a href='update.php?id=". $row['id'] ."' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                echo "</td>";
                                echo "</tr>";
                            }

                        }
                        echo "</tbody>";
                        echo "</table>";
                        // Free result set
                        mysqli_free_result($result);
                    } else{
                        echo "<p class='lead'><em>No records were found.</em></p>";
                    }
                } else{
                    echo "ERROR: Could not able to execute ". $sql. " " . mysqli_error($conn);
                }

                // Close connection
                mysqli_close($conn);
                ?>
            </div>
        </div>
    </div>
</div>

<p><a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a></p>
</body>
</html>