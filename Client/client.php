


<?php


require_once 'config.php';
// Initialize the session
session_start();
//// If session variable is not set it will redirect to login page
//if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
   // header("location: login.php");
   // exit;//

?>

<?php
$satifaction_input='';
if(isset($_POST['submitBtn']))
{	$name=$_POST['satisfaction_in'];
echo'thank you for your feedback';
}
?>

<!DOCTYPE html>

<html>
<head>
<title>
Client Page
</title>
</head>
<body>
<form action="client.php" method="post">
<input type="number" name="satisfaction_in" placeholder="Please enter your satifaction number(1-10)">
<input type="submit" name="submitBtn" placeholder="Submit">

</form>
<li><em>Satisfaction:</em> <?php echo $_POST["name"]?></li>
<?php
$link = mysqli_connect("localhost", "root", "", "yousef");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Attempt insert query execution
$sql ="INSERT INTO Client (name,phone_number, email, city,
 province,postal_code,satisfaction) VALUES('Yousef',5147702,'gmail',
 'Montreal','QC','HR','".$_POST["name"]."')";
if(mysqli_query($link, $sql)){
    echo "Records inserted successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
// Close connection
mysqli_close($link);
echo "client will be able to see all active/expired contracts";
echo "<br>";
echo"\n\r clients will be able to provide my satifaction score";
echo "<br>";
echo"\n\r clients will be able to check satisfaction score of all the contracts managed by the manager"



?>
</body>
</html>
