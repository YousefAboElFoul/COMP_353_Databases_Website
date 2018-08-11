<?php
// Initialize the session
session_start();
require_once "../config.php";

// Unset all of the session variables
$_SESSION = array();

// Destroy the session.
session_destroy();

// Redirect to login page
header("location: " . $base_url . "SalesAssociate/login.php");
exit;
?>