<?php

include 'connect.php';

session_start();
$_SESSION['postmessage'] = '';

$title = mysqli_real_escape_string($conn, $_POST['title']);
$content = mysqli_real_escape_string($conn, $_POST['content']);
$user = $_SESSION['user'];

$sql = "INSERT INTO posts (post_title,post_content,post_date,post_by)
        values ('$title','$content',NOW(),'$user')";

if(mysqli_query($conn, $sql)) {
    header("Location: .././");
} else {
    $_SESSION['postmessage'] = 'Post could not be created';
    header("location: ../createpost.php#posterror");
}