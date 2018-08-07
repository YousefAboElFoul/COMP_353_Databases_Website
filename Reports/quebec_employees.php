<?php
//echo "working";
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
<h3>Employees from Quebec</h3>
<div>
    <table class='table table-bordered table-striped'>
        <thead>
        <tr>
            <th>Employee Id</th>
            <th>Name</th>
            <th>Home Province</th>
            <th>Contract Type</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
<?php

    $sql = "SELECT Employee.id AS emp_id, Employee.name AS emp_name, Employee.home_province AS prov, 
            Contract_type.name AS con_type  FROM Employee INNER JOIN Contract_type ON
             Employee.contract_type = Contract_type.id WHERE home_province LIKE ?";

    if($stmt = mysqli_prepare($conn, $sql)) {
        // echo "working";
        mysqli_stmt_bind_param($stmt, "s", $param1);
        $param1 = "%Quebec%";
        if(mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            if(mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_array($result)){
                    echo "<tr>";
                    echo "<td>" . $row['emp_id'] . "</td>";
                    echo "<td>" . $row['emp_name'] . "</td>";
                    echo "<td>" . $row['prov'] . "</td>";
                    echo "<td>" . $row['con_type'] . "</td>";
                    echo "</tr>";
                }

            }
        }
    } else {
        echo "SQL stmt not prepared";
    }
    ?>
        </tbody>
    </table>

</body>
</html>