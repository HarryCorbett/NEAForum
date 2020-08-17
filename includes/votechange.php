<?php
session_start();
include 'header.php';
include 'connect.php';

$replyid = $_GET['replyid'];
$postid = $_GET['postid'];
$value = $_GET['value'];
$currentuser = $_SESSION['user'];

if (isset($replyid)) {
    if ($value == 1) {
        $sql = "UPDATE votes SET value = -1 WHERE reply_id = '$replyid' AND user_id = '$currentuser'";
    } elseif ($value == -1) {
        $sql = "UPDATE votes SET value = 1 WHERE reply_id = '$replyid' AND user_id = '$currentuser'";
    }

    if (mysqli_query($conn, $sql)) {
        header("location: ../postpage.php?postid=$postid");
    } else {
        echo "an error has occurred";
    }
}