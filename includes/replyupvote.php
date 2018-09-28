<?php

session_start();
include 'connect.php';

echo "hello";

if (isset($_GET['replyid'])) {
    $replyid = $_GET['replyid'];}

    $postid = $_GET['postid'];

echo "post id =$postid";
echo " reply id =$replyid";

$sql = "UPDATE replies set upvotes = (upvotes + 1) where reply_id = '$replyid'";
if (mysqli_query($conn,$sql)) {
    header("location: ../postpage.php?postid=$postid");
    }else{
    echo "an error has occurred";
}

?>