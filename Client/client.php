<?php
// Initialize the session
session_start();
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
    header("location: login.php");
    exit;
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

<?php
//have to validate whether client has contracts or not
$Contract_validate = "SELECT * FROM Contract, Client WHERE Contract.id=Client.id";
if(!$Contract_validate)
{
	echo"You don't have any active contracts";
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
