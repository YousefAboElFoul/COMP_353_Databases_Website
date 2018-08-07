<?php
// Initialize the session
session_start();
require_once '../config.php';

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
    <div>
        <h2><br><b>Reports</b></h2>
        <h3>1. Clients with highest number of contracts per line of business</h3>
        <p><a href="contracts_business.php" class="btn btn-success">Go</a></p>
    </div>

    <div>
        <h3>2. Contracts signed in the last 10 days</h3>
        <p><a href="ten_days.php" class="btn btn-success">Go</a></p>
    </div>

    <div>
        <h3>3. Employees with home province of Quebec</h3>
        <p><a href="quebec_employees.php" class="btn btn-success">Go</a></p>
    </div>

    <div>
        <h3>4. Contracts in the gold category</h3>
        <p><a href="gold_contracts.php" class="btn btn-success">Go</a></p>
    </div>

    <div>
        <h3>5. Clients with highest satisfaction scores by contract category per city</h3>
        <p><a href="satisfaction.php" class="btn btn-success">Go</a></p>
    </div>



    <p><a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a></p>
</body>
</html>
