<?php
include 'connect.php';

session_start();
$_SESSION['message'] = '';

//checking passwords match
if($_POST['password'] == $_POST['confirm_password']) {

    //real escape string used to convert special characters (especially \) into other strings to prevent risk
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // hash passwords for security

    $_SESSION['username'] = $username;

    $sql = "INSERT INTO users (email, name, password, date, rating)
            VALUES ('$email', '$username', '$password', NOW(), 0)";

    if(mysqli_query($conn, $sql)) {
        $_SESSION['message'] = 'registration complete';
    } else {
        $_SESSION['message'] = 'User could not be created';
    }
} else {
    $_SESSION['message'] = 'Passwords do not match';
}

header("Location: ../");