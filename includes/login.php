<?php
include 'connect.php';

session_start();
$_SESSION['loginmessage'] = '';

if(isset($_POST['email'])) {

    //Prevent sql injection
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);


    $sql = "select password from users where email = '$email'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $hash = $row['password'];


    if ($hash === NULL) {
        $_SESSION['loginmessage'] = 'That email is not linked to an account';
        header("location: ..#loginerror");
    } else {

        if (password_verify($password, $hash)) {

            $sql = "select id from users where email = '$email' and password = '$hash'";
            $result = @mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

            $_SESSION['user'] = $row['id'];
            $_SESSION['username'] = $row['name'];


            $_SESSION['loginmessage'] = '';
            header("location: .././");

        } else {
            $_SESSION['loginmessage'] = 'Incorrect email or password';
            header("location: ..#loginerror");
        }
    }
}










