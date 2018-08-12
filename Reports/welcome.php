<?php
// Initialize the session
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
    </div>
    <div>
        <h2><br><b>Reports</b></h2>
        <h3>1. Clients with highest number of contracts per line of business</h3>
        <p><a href="contracts_business.php" class="btn btn-success">Go</a></p>
    </div>

    <div>
        <h3>2. Contracts signed in the last 10 days by Sales Associate</h3>
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
        <p><a href="report5.php" class="btn btn-success">Go</a></p>
    </div>
	
	 <div>
        <h3>6. Number of employees with Premium Employee plan with working hours less than 60 hrs/month</h3>
        <p><a href="overloaded_type1_employees.php" class="btn btn-success">Go</a></p>
    </div>
	
	 <div>
        <h3>7.Number of Premium contracts delivered in more than 10 business days having more than 35 employees with “Silver Employee Plan </h3>
        <p><a href="newreport2.php" class="btn btn-success">Go</a></p>
    </div>

	</body>
</html>
