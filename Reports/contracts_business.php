<?php
session_start();
require_once '../config.php';
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
    <h1>Lines of Business</h1>
</div>

<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header clearfix">
                </div>
                <?php

                require_once '../config.php';
                //$manager_id = 0;
                $sql = "SELECT * FROM Line_business";
                if($stmt = mysqli_prepare($conn, $sql)) {
                    //mysqli_stmt_bind_param($stmt, "i", $param1);
                    //$param1 = $manager_id;
                    if(mysqli_stmt_execute($stmt)) {
                        $result = mysqli_stmt_get_result($stmt);
                        if(mysqli_num_rows($result) > 0){

                            // THIS TABLE IS MISSING VALUES
                            echo "<table class='table table-bordered table-striped'>";
                            echo "<thead>";
                            echo "<tr>";
                            echo "<th>Name</th>";
                            echo "<th></th>";

                            echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                            while($row = mysqli_fetch_array($result)){
                                echo "<tr>";
                                echo "<td>" . $row['name'] . "</td>";
                                echo "<td>";
                                echo "<a href='view_business_line.php?businessline_id=". $row['id'] ."' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
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
                        echo "Could not execute sql statement";
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
