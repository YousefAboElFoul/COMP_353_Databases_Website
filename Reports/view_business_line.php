<?php
session_start();
require_once '../config.php';

if(!isset($_GET['businessline_id']) || empty($_GET['businessline_id'])){
    header("location: ". $base_url . "/Manager/login.php");
    exit;
} else {
    $business_line_id = $_GET['businessline_id'];
}

//echo $business_line_id;
$sql = "SELECT * FROM Line_business WHERE id = ?";
$business_line_name ="";

if($stmt = mysqli_prepare($conn, $sql)) {
    //echo "working";
    mysqli_stmt_bind_param($stmt, "i", $param1);
    $param1 = $business_line_id;
    if (mysqli_stmt_execute($stmt)) {
        //echo "working2";
        $result = mysqli_stmt_get_result($stmt);
        if(mysqli_num_rows($result) > 0) {
            //echo "working3";
            if(mysqli_num_rows($result) == 1) {
                //echo "working4";
                $row = mysqli_fetch_assoc($result);
                $business_line_name = $row['name'];
                //echo $business_line_name;
            }
        }
    }
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
    <h1>Clients with the Most Contracts Under <?php echo $business_line_name ?></h1>
</div>

<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header clearfix">
                </div>
                    <table class='table table-bordered table-striped'>
                        <thead>
                            <tr>
                                <th>Client ID</th>
                                <th>Line Of Business</th>
                                <th>Contract Count</th>
                            </tr>
                        </thead>
                    <tbody>
                    <?PHP
                        $sql = "SELECT client_id, line_business, MAX(counted_contracts)
                                AS max_ FROM (SELECT client_id, line_business, COUNT(*) 
                                AS counted_contracts FROM Contract GROUP BY client_id, line_business)
                                AS counted GROUP BY client_id, line_business Having line_business = ? 
                                ORDER BY max_ DESC LIMIT 1";

                        if($stmt = mysqli_prepare($conn, $sql)) {
                            //echo "working";
                            mysqli_stmt_bind_param($stmt, "i", $param1);
                            $param1 = $business_line_id;
                            if (mysqli_stmt_execute($stmt)) {
                                //echo "working2";
                                $result = mysqli_stmt_get_result($stmt);
                                if(mysqli_num_rows($result) > 0) {
                                    //echo "working3";
                                    if(mysqli_num_rows($result) == 1) {
                                        $row = mysqli_fetch_assoc($result);
                                        $sql_1 = "SELECT name FROM Client WHERE id = ?";
                                        if($stmt_1 = mysqli_prepare($conn, $sql_1)) {
                                            //echo "working";
                                            mysqli_stmt_bind_param($stmt_1, "i", $param1);
                                            $param1 = $row['client_id'];
                                            if (mysqli_stmt_execute($stmt_1)) {
                                                $result_1 = mysqli_stmt_get_result($stmt_1);
                                                if(mysqli_num_rows($result_1) == 1) {
                                                    $row_1 = mysqli_fetch_assoc($result_1);
                                                    $client_name = $row_1['name'];
                                                }

                                            }
                                        }

                                        echo "<tr><td>" . $client_name ."</td>";
                                        echo "<td>" . $business_line_name . "</td>";
                                        echo "<td>" . $row['max_'] . "</td></tr>";
                                    }
                                }
                            }
                        }
                        ?>
                    </tbody>
                    </table>
            </div>
        </div>
    </div>
</div>

<p><a href=<?php echo $base_url . "Manager/logout.php" ?> class="btn btn-danger">Sign Out of Your Account</a></p>
</body>
</html>