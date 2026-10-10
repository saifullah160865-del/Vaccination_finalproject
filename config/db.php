<?php
session_start();
$host = "localhost";
$username = "root";
$password = "";
$database = "vaccination_system";

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Database Connection Failed: " . mysqli_connect_error());
}
?>
