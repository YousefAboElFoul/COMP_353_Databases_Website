<!DOCTYPE html>
<html lang="en">
<?php
// Initialize the session
session_start();
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
    header("location: login.php");
    exit;
}
?>
<head>
    <meta charset="UTF-8">
    <title>Satisfaction Form</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 750px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <h2>Contact Us</h2>
    <p>Please fill in your satsifaction rated between (1-10) and send us.</p>
    <form action="" method="post">
        <p>
            <label for="inputnumber">Satisfaction:<sup>*</sup></label>
            <input type="number_format" name="Satisfaction_num" id="inputnumber">
        </p>
     
        <input type="submit" value="Submit">
        <input type="reset" value="Reset">
    </form>
	<!--<li><em>Satisfaction:</em> <?php echo $_POST["name"]?></li>-->
<?php
require_once 'config.php';

$UserId = $_POST['Satisfaction_num'];
 
// Attempt insert query execution
$sql ="INSERT INTO Client (client_satisfaction) VALUES('Satisfaction_num') WHERE client";
if(mysqli_query($conn, $sql)){
    echo "Records inserted successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
}
 
// Close connection
mysqli_close($conn);
echo "client will be able to see all active/expired contracts";
echo "<br>";
echo"\n\r clients will be able to provide my satifaction score";
echo "<br>";
echo"\n\r clients will be able to check satisfaction score of all the contracts managed by the manager"



?>
</body>
</html>