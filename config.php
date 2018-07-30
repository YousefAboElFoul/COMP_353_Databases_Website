<?php

const DEV = "dev";  // development

const YazanDEV = "yazanDev";

const PROD = "prod";  // production


$environment = DEV;
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */

if($environment == DEV) {
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
    } {
        //echo "connected to db\n";  // TESTING
    }
} else {
    // production setup goes here, so can run on school servers
}

?>
