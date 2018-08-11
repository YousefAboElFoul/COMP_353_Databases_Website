<?php
// Initialize the session
session_start();
require_once '../config.php';

if(!isset($_GET['id']) || empty($_GET['id'])){
    header("location: welcome.php");
    exit;
} else {
    $month = $_GET['id'];
}

$month_name = '';

function getMonth($param){
    global $month_name;
    switch ($param) {
        case "01":
            $month_name = 'Jan';
            break;
        case "02":
            $month_name = "Feb";
            break;
        case "03":
            $month_name = "March";
            break;
        case "04":
            $month_name = "April";
            break;
        case "05":
            $month_name = "May";
            break;
        case "06":
            $month_name = "June";
            break;
        case "07":
            $month_name = "July";
            break;
        case "08":
            $month_name = "Aug";
            break;
        case "09":
            $month_name = "Sept";
            break;
        case "10":
            $month_name = "Oct";
            break;
        case "11":
            $month_name = "Nov";
            break;
        case "12":
            $month_name = "Dec";
            break;
    }
}

getMonth($month);
//echo "month ". $month_name;

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
                    <h2 class="pull-left">
                        Comparing Delivery Schedules of First Deliverable for <?php echo $month_name ?>
                    </h2>
                </div>

                <table class='table table-bordered table-striped'>
                    <thead>
                    <tr>
                        <th>Start Date</th>
                        <th>First Deliverable</th>

                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $sql = "  SELECT DATE(start_date) AS start, first_deliverable  
                              FROM Contract WHERE MONTH(first_deliverable) = ? AND YEAR(start_date) = 2017";
                    if($stmt = mysqli_prepare($conn, $sql)) {
                        mysqli_stmt_bind_param($stmt, "i", $param1);
                        $param1 = $month;
                        if(mysqli_stmt_execute($stmt)) {
                            $result = mysqli_stmt_get_result($stmt);
                            if(mysqli_num_rows($result) > 0){
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                    echo "<td>" . $row['start'] . "</td>";
                                    echo "<td>" . $row['first_deliverable'] . "</td>";
                                    echo "</tr>";
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
</body>
</html>