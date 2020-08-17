<?php
include 'connect.php';
session_start();

$userid = $_GET['userid'];

$sql = "DELETE FROM users WHERE id = '$userid'";

if (mysqli_query($conn, $sql)) {
    header("location: Logout.php");
} else {
    echo "could not delete account";
}