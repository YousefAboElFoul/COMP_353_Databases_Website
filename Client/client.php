<?php
// Initialize the session
require_once 'config.php';
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

<?php
//have to validate whether client has contracts or not
$sql = "SELECT id FROM Contract , Client WHERE Contract.id=Client.id";
if(!$sql){
	echo "You dont have any active contracts";
	header("location:welcome.php");
}

 $data_in="INSERT INTO Client (name,phone_number, email, city,
 province,postal_code,satifaction) VALUES("Yousef",514770,"gmail",
 "Montreal","QC",'HR',satisfaction_in)";

 
echo "client will be able to see all active/expired contracts";
echo "<br>";
echo"\n\r clients will be able to provide my satifaction score";
echo "<br>";
echo"\n\r clients will be able to check satisfaction score of all the contracts managed by the manager"



?>
</body>
</html>
