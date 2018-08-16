<?php
include 'connect.php';

session_start();
$_SESSION['message'] = '';

if(isset($_POST['email'])){

    //Prevent sql injection
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);


    $sql = "select password from users where email = '$email'";
    $result = @mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $hash = $row['password'];


    if ($hash === NULL){
        echo 'didnt work';
    $_session['message'] = 'This email is not linked to an account';
    }else{

        if (password_verify($password,$sql));
        {
            $sql = "select id from users where email = '$email' and password = '$hash'";
            $result = @mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

            $_session['user'] = $row['user'];

            header("location: index.php");
        }


    }
}










