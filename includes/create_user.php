<?php
include 'connect.php';

session_start();
$_SESSION['createmessage'] = '';

//checking passwords match
if($_POST['password'] == $_POST['confirm_password']) {

    //real escape string used to convert special characters (especially \) into other strings to prevent risk
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // hash passwords for security

    if (isvalid($email) == true ) {
        $_SESSION['createmessage'] = 'Invalid email address format';
        header("location: ../#createerror");
    }

    function isvalid($email){
        return filter_var($email, FILTER_VALIDATE_EMAIL)
            && preg_match('/@.+\./', $email);
    }

    $username = trim($username,"' ', ''" );
    $username = str_replace(" ","_",$username);

    $_SESSION['username'] = $username;

    $sql = "INSERT INTO users (email, name, password, date, rating)
            VALUES ('$email', '$username', '$password', NOW(), 0)";


    if(mysqli_query($conn, $sql)) {
        header("Location: .././");
    } else {
        $_SESSION['createmessage'] = 'User could not be created';
        header("location: ../#createerror");
    }
} else {
    $_SESSION['createmessage'] = 'Passwords do not match';
    header("location: ../#createerror");
}

