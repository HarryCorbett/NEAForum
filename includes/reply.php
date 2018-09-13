<?php

include 'connect.php';
session_start();

$content = mysqli_real_escape_string($conn, $_POST['reply_content']);
$user = $_SESSION['user'];
$postid = $_POST['postid'];


$sql = "INSERT INTO replies (reply_content, reply_date, reply_post, reply_by)
        values ('$content',NOW(),'$postid','$user')";

if(mysqli_query($conn, $sql)) {
    header("Location: ../postpage.php?postid=$postid");
} else {
    header("location: ../");
}
