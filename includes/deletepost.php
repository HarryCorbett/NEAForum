<?php
include 'connect.php';
session_start();

$postid = $_GET['postid'];

$sql = "DELETE FROM posts WHERE post_id = '$postid'";

if (mysqli_query($conn, $sql)) {
    header("location: ../");
} else {
    echo "could not delete post";
}
