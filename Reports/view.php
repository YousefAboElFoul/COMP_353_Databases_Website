<?php
// Initialize the session
session_start();
require_once '../config.php';

if(!isset($_GET['sales_id']) || empty($_GET['sales_id'])){
    header("location: welcome.php");
    exit;
} else {
    $sales_id = $_GET['sales_id'];
}

if(!isset($_GET['sales_name']) || empty($_GET['sales_name'])){
    header("location: welcome.php");
    exit;
} else {
    $sales_name = $_GET['sales_name'];
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

<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header clearfix">
                    <h2 class="pull-left">Contracts for <?php echo $sales_name ?></h2>
                </div>
                <?php
                echo "<table class='table table-bordered table-striped'>";
                echo "<thead>";
                echo "<tr>";
                echo "<th>Contract Id</th>";
                echo "<th>Responsible ID</th>";
                echo "<th>ACV</th>";
                echo "<th>Initial Amount</th>";
                echo "<th>Start Date</th>";
                echo "<th>Contract Type</th>";

                echo "<th>Service Type</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";

                //$manager_id = 0;
                $sql = "SELECT 
                        Contract.id AS con_id, 
                        Contract.client_id, 
                        Contract.responsible_id, 
                        Contract.acv, Contract.initial_amount,
                        Contract.service_type, 
                        Contract.client_satisfaction, 
                        Contract_type.name AS Con_name, 
                        Contract_type.id AS Con_type_id,  
                        Service_type.name AS Serv_name, 
                        Contract.start_date
                        FROM Contract_type INNER JOIN Contract ON 
                        Contract.contract_type = Contract_type.id INNER JOIN Service_type 
                        ON Contract.service_type = Service_type.id WHERE
                        sales_associate = ? AND Contract.start_date >= DATE_ADD(CURDATE(), INTERVAL -10 DAY)";

               // $sql = "SELECT * FROM Contract WHERE sales_associate = ?";
                if($stmt = mysqli_prepare($conn, $sql)) {
                    //echo "working";
                    mysqli_stmt_bind_param($stmt, "i", $param1);
                    $param1 = $sales_id;
                    if(mysqli_stmt_execute($stmt)) {
                        $result = mysqli_stmt_get_result($stmt);
                        if(mysqli_num_rows($result) > 0){
                            //echo "working2";

                            while($row = mysqli_fetch_array($result)){
                                echo "<tr>";
                                echo "<td>" . $row['con_id'] . "</td>";
                                echo "<td>" . $row['responsible_id'] . "</td>";
                                echo "<td>" . $row['acv'] . "</td>";
                                echo "<td>" . $row['initial_amount'] . "</td>";
                                echo "<td>". $row['start_date'] . "</td>";
                                echo "<td>". $row['Con_name'] . "</td>";
                                echo "<td>". $row['Serv_name'] . "</td>";

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