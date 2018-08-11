<?php
// Initialize the session
session_start();
require_once '../config.php';


// If session variable is not set it will redirect to login page
//if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
//    header("location: ". $base_url . "Manager/login.php");
//    exit;
//}

//if(isset($_SESSION['manager_id']) && !empty($_SESSION['manager_id'])) {
//    $manager_id = $_SESSION['manager_id'];
//    //echo "manager_id = ". $manager_id;
//} else {
//    echo "No manager id";
//}
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
                    <h2 class="pull-left">First Deliverable for 2017</h2>
                </div>

                <table class='table table-bordered table-striped'>
                    <thead>
                    <tr>
                        <th>Month</th>
                        <th>View Month</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>January</td>
                            <td><a href='month.php?id=01' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a></td>
                        </tr>
                        <tr>
                            <td>Febuary</td>
                            <td><a href='month.php?id=02' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a></td>
                        </tr>
                        <tr>
                            <td>March</td>
                            <td><a href='month.php?id=03' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a></td>
                        </tr>
                        <tr>
                            <td>April</td>
                            <td><a href='month.php?id=04' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a></td>
                        </tr>
                        <tr>
                            <td>May</td>
                            <td><a href='month.php?id=05' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a></td>
                        </tr>
                        <tr>
                            <td>June</td>
                            <td><a href='month.php?id=06' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a></td>
                        </tr>
                        <tr>
                            <td>July</td>
                            <td><a href='month.php?id=07' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a></td>
                        </tr>
                        <tr>
                            <td>August</td>
                            <td><a href='month.php?id=08' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a></td>
                        </tr>
                        <tr>
                            <td>September</td>
                            <td><a href='month.php?id=09' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a></td>
                        </tr>
                        <tr>
                            <td>October</td>
                            <td><a href='month.php?id=10' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a></td>
                        </tr>
                        <tr>
                            <td>November</td>
                            <td><a href='month.php?id=11' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a></td>
                        </tr>
                        <tr>
                            <td>December</td>
                            <td><a href='month.php?id=12' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a></td>
                        </tr>
                    </tbody>
                    </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>