<?php

const DEV = "dev";  // development

const RyanDEV = "ryanDev";
const YazanDEV = "yazanDev";
const YousefDEV = "yousefDev";
const HannaDEV = "hannaDev";

const PROD = "prod";  // production


$environment = YazanDEV; // choose your dev here
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */

if($environment == RyanDEV) {
    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', 'mysql');
    define('DB_NAME', 'rcc353_1');

    /* Attempt to connect to MySQL database */
    $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    $base_url = "/project/COMP_353_Databases_Website/";
// Check connection
    if($conn === false) {
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
	else
	{
        //echo "connected to db & ryan's config\n";  // TESTING

    }
}
else if($environment == YazanDEV) {
    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'yazan');

    /* Attempt to connect to MySQL database */
    $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    $base_url = "/project/COMP_353_Databases_Website/";
// Check connection
    if($conn === false) {
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }else {
        echo "connected to db and yazan's config\n";  // TESTING
    }
}
else if($environment == YousefDEV) {
    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'yousef');

    /* Attempt to connect to MySQL database */
    $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    $base_url = "/project/COMP_353_Databases_Website/";
// Check connection
    if($conn === false) {
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
	else {
        //echo "connected to db\n";  // TESTING
    }
}	
else if($environment == HannaDEV) {
    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'hanna');

    /* Attempt to connect to MySQL database */
    $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    $base_url = "/project/COMP_353_Databases_Website/";
// Check connection
    if($conn === false) {
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
	else
	{
        echo "connected to db\n";  // TESTING
    }
} else {
    // production setup goes here, so can run on school servers
    define('DB_SERVER', 'rcc353.encs.concordia.ca');
    define('DB_USERNAME', 'rcc353_1');
    define('DB_PASSWORD', 'RYYMH967');
    define('DB_NAME', 'rcc353_1');

    /* Attempt to connect to MySQL database */
    $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    $base_url = "/project/COMP_353_Databases_Website/";
// Check connection
    if($conn === false) {
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
    else
    {
        //echo "connected to db\n";  // TESTING
        echo "";
    }
}

?>
