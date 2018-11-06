<?php

session_start();
include 'connect.php';
include 'header.php';

$title = mysqli_real_escape_string($conn, $_POST['title']);
$content = mysqli_real_escape_string($conn, $_POST['content']);
$user = $_SESSION['user'];
$postid = $_GET['postid'];

$sql = "UPDATE posts SET post_title = '$title' , post_content = '$content' where post_id = '$postid'";

if(mysqli_query($conn,$sql)){
    header("location: ../");
}else{
    echo "failed to update post";
}


