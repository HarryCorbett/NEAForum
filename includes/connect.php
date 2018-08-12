<?php
$server_name = "localhost";
$username = "root";
$password = "root";

// Create connection
$conn = mysqli_connect($server_name, $username, $password, "forum");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}