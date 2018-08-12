<?php
include 'connect.php';

session_start();
$_SESSION['message'] = '';

if(isset($_POST['email'])){

    $email = mysqli_real_escape_string($conn, $_post['email']);
    $password = mysqli_real_escape_string($conn, $_post['password']);

    $sqlemail = ("select * from users where email = $email limit 1");
    //select count(*) from users where email = '$email' and password = '$password' limit 1

    $result = mysqli_query($conn, $sqlemail);


    if(mysqli_num_rows($result) === 1);{
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        if (password_verify($password, $row['password'])) {
            echo "Login successful";
        }else{
            echo "details incorrect";
        }

    }

}



