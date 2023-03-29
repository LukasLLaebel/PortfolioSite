<?php
$username = "username";
$password = "pass";
$database = "database_username";
$server = "server";

// Connect to db
$connect = mysqli_connect($server, $username, $password, $database);

if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

?>



