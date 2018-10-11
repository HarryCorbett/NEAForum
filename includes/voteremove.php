<?php

session_start();
include 'header.php';
include 'connect.php';

if (isset($_GET['replyid'])) {

$replyid = $_GET['replyid'];}
$postid = $_GET['postid'];
$value = $_GET['value'];
$currentuser = $_SESSION['user'];

$sql = "DELETE FROM votes WHERE reply_id = $replyid AND user_id = $currentuser";
if (mysqli_query($conn,$sql)) {
    header("location: ../postpage.php?postid=$postid");
}else{
    echo "an error has occurred";
}