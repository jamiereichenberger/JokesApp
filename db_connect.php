<?php
// these are four variables to connect the database
$host = "localhost";
$username = "root";
$user_pass = "usbw";
$database_in_use = "test";

// create a database connection instance
$mysqli = new mysqli($host, $username, $user_pass, $database_in_use);
?>