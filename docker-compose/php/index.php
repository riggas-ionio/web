<?php
// Database connection parameters
$servername = "di_inter_tech_mysql"; // Change this to your database server name if necessary
$host = "localhost";
$dbname = "project";
$username = "root";
$password = "";

// Create connection
$mysqli = new mysqli(hostname: $host,
                     username: $username,
                     password: $password,
                     database: $dbname);
// Check connection
if ($mysqli->connect_errno) {
    die("Connection error: " . $mysqli->connect_error);
}

return $mysqli;
?>
