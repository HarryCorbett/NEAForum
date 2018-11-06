<?php

include 'connect.php';
session_start();

$replyid = $_GET['replyid'];
$postid = $_GET['postid'];


$sql = "DELETE FROM replies WHERE reply_id = '$replyid'";

if (mysqli_query($conn, $sql)){
    header("location: ../postpage.php?postid=$postid");
}else{
    echo "could not delete reply";
}

