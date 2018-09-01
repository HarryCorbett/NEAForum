<head>
    <link rel="Stylesheet" type="text/css" href="css/app.css"/>
</head>

<?php

session_start();
include 'includes/connect.php';

if (isset($_SESSION['user'])) {
    include 'navbar_loggedin.php';
} else {
    include 'navbar_loggedout.php';
}

?>

    <div style="margin-left:25%; margin-right:25%; margin-top: 5%;">
        <table>

                    <?

                if (isset($_GET['postid'])) {
                    $postid = $_GET['postid'];}

                $sql = "SELECT * FROM posts WHERE post_id = '$postid' ";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                $blob = $row['post_content'];


                // finding username for user id of poster
                $post_user = $row['post_user'];

                $sql2 = "SELECT DISTINCT name FROM users WHERE id = '$post_user' ";
                $result2 = mysqli_query($conn, $sql2);
                $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
                $name = $row2['name'];


                ?>

                <div style = "letter-spacing: 2px; border-bottom:1px solid #ccc ; padding-bottom: 0px;">
                    <label > <? echo $row['post_title'] ?></label><br><br>
                    <label > content will go here </label><br><br>
                    <label > <? echo $name ?> </label>
                    <label class = "w3-right" > <? echo $row['post_date'] ?></label>
                    <!-- <a href="Uploads/" download>Download attachment</a> -->
                    <br>
                </div>
                <br><br>

</div>