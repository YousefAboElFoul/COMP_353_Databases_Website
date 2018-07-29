<?php
// Initialize the session
session_start();
//// If session variable is not set it will redirect to login page
//if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
   // header("location: login.php");
   // exit;//

?>

<?php
$satifaction_input='';
if(isset($_POST[submitBtn]))
{	$name=$_POST['satifaction'];
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
<form acton="client.php" method="post">
<input type="number" name="satifaction" placeholder="Please enter your satifaction number(1-10)">
<input type="submit" name="submitBtn" placeholder="Submit">

</form>

<?php
//have to validate whether client has contracts or not
$sql = "SELECT id FROM Contract , Client WHERE Contract.id=Client.id";
if(!$sql){
	echo "You dont have any active contracts";
	header("location:welcome.php");
}

 

 
echo "client will be able to see all active/expired contracts";
echo "<br>";
echo"\n\r clients will be able to provide my satifaction score";
echo "<br>";
echo"\n\r clients will be able to check satisfaction score of all the contracts managed by the manager"



?>
</body>
</html>
