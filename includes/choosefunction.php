<?php

session_start();
include 'header.php';
include 'connect.php';

$value = $_GET['value'];
$replyid = $_GET['replyid'];
$postid = $_GET['postid'];

if ($_GET['upordown'] == 1 ){

?>

<script>

        if (<? echo $value ?> == 0){
        window.location = "voteadd.php?replyid=<? echo $replyid; ?>&postid=<? echo $postid ?>&uord=<? echo '1' ?>";

        }else if (<? echo $value ?> == 1){
            window.location = "voteremove.php?replyid=<? echo $replyid; ?>&postid=<? echo $postid ?>&value=<? echo $value ?>"

        }else if (<? echo $value ?> == -1) {
            window.location = "votechange.php?replyid=<? echo $replyid; ?>&postid=<? echo $postid ?>&value=<? echo $value ?>"
        }

</script>

<? }
if ($_GET['upordown'] == -1){ ?>

    <script>
        if (<? echo $value ?> == 0){
        window.location = "voteadd.php?replyid=<? echo $replyid; ?>&postid=<? echo $postid ?>&uord=<? echo '-1' ?> ";

        }else if (<? echo $value ?> == 1){
        window.location = "votechange.php?replyid=<? echo $replyid; ?>&postid=<? echo $postid ?>&value=<? echo $value ?>"

        }else if (<? echo $value ?> == -1) {
        window.location = "voteremove.php?replyid=<? echo $replyid; ?>&postid=<? echo $postid ?>&value=<? echo $value ?>"
        }
    </script>

<? }  ?>
