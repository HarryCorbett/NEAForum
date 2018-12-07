<?php

session_start();
include 'includes/header.php';
include 'includes/connect.php';

if (isset($_SESSION['user'])) {
    include 'navbar_loggedin.php';
} else {
    include 'navbar_loggedout.php';
}

$userid = $_SESSION['user'];

$sql = "SELECT email,name,date FROM users WHERE id = $userid ";
$details = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($details,MYSQLI_ASSOC);

$repquery = "SELECT SUM(value) AS rep FROM votes,replies WHERE replies.reply_id = votes.reply_id AND replies.reply_by = '$userid'";
$fetchrep = mysqli_query($conn, $repquery);
$reprow = mysqli_fetch_array($fetchrep, MYSQLI_ASSOC);
$rep = $reprow['rep'];

if (empty($rep)){
    $rep = '0';
}


?>

<div style="margin-left:25%; margin-right:25%; margin-top: 5%; margin-bottom: 5%; letter-spacing: 2px; font-family: 'Times New Roman', Times, serif;" >

    <h2 class="w3-select" style="font-family: 'Times New Roman', Times, serif;"> <? echo $row['name'] ?> </h2>
    <br>
    <h3 style="font-family: 'Times New Roman', Times, serif;"> Details </h3>
    <label class=""> Reputation:  <? echo $rep ?> </label><br>
    <label class=""> Email:  <? echo $row['email'] ?> </label><br>
    <label class=""> Account created:  <? echo $row['date'] ?> </label>
    <br><br><br>
    <a class="fas fa-trash-alt fa-1.5x w3-text-dark-gray" href="includes/deleteaccount.php?userid=<? echo $userid ?>" >Delete account</a>

</div>
