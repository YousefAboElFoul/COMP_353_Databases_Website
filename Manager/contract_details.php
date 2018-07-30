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
                    <h2 class="pull-left">Company Worker Details</h2>
                    <a href="create.php" class="btn btn-success pull-right">Add New Employee</a>
                </div>
                <?php

                // I SHOULD ACTUALLY HAVE THE LIST OF CONTRACTS FOR THIS MANAGER HERE
                // WHERE EDITING --> NEW PAGE THAT SHOWS THE CONTRACT DETAILS AND THE LIST OF
                // EMPLOYEES WORKING ON IT WHERE MANAGER CAN ADD AN EMPLOYEE IF THEIR PREFERANCE MATCHES
                // THIS CONTRACT
                // Include config file
                require_once '../config.php';
                $manager_id = 0;
                $sql = "SELECT id FROM manager WHERE user_name = ?";
                if($stmt = mysqli_prepare($conn, $sql)){
                    mysqli_stmt_bind_param($stmt,  "s",  $param1);
                    $param1 = $_SESSION['username'];
                    if(mysqli_stmt_execute($stmt)) {
                        $result = mysqli_stmt_get_result($stmt);
                        if(mysqli_num_rows($result) == 1){
                            $first_row = mysqli_fetch_assoc($result);
                            $manager_id = $first_row['id'];
                        }
                    }
                }

                // Attempt select query execution
                $sql = "SELECT * FROM company_worker WHERE manager_id = ?";
                if($stmt = mysqli_prepare($conn, $sql)) {
                    mysqli_stmt_bind_param($stmt, "s", $param1);
                    $param1 = $manager_id;
                    if(mysqli_stmt_execute($stmt)) {
                        $result = mysqli_stmt_get_result($stmt);
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
                                $contract_query = "SELECT name FROM contract_type WHERE id = ". $row['contract_type_id'];
                                if($contract_result = mysqli_query($conn, $contract_query)) {
                                    $contract_type_rows = mysqli_fetch_array($contract_result);
                                    //$contract_type_row_zero = $contract_type_rows[0];
                                    $contract_type = $contract_type_rows['name'];
                                }
                                echo "<tr>";
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td>" . $row['name'] . "</td>";
                                echo "<td>" . $row['user_name'] . "</td>";
                                echo "<td>" . $row['password'] . "</td>";
                                echo "<td>". $contract_type . "</td>";
                                echo "<td>";
                                echo "<a href='read.php?id=". $row['id'] ."' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                                echo "<a href='update.php?id=". $row['id'] ."' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                echo "<a href='delete.php?id=". $row['id'] ."' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
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
        </div>
    </div>
</div>

<p><a href=<?php echo $base_url . "Manager/logout.php" ?> class="btn btn-danger">Sign Out of Your Account</a></p>
</body>
</html>