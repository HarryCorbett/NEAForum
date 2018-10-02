<?php

session_start();
include 'header.php';
include 'connect.php';

echo "hello";

if (isset($_GET['replyid'])) {
    $replyid = $_GET['replyid'];}

    $postid = $_GET['postid'];

    $currentuser = $_SESSION['user'];

echo "post id =$postid";
echo " reply id =$replyid";

$sql = "INSERT INTO votes VALUES ($replyid, $currentuser, 1)";
if (mysqli_query($conn,$sql)) {
    header("location: ../postpage.php?postid=$postid");
    }else{
    echo "an error has occurred";
}

?>