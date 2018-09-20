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

    <!-- display the post -->
    <div style="margin-left:25%; margin-right:25%; margin-top: 5%; margin-bottom: 5%;">
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
                    <label >
                        <?php
                            $blobpost = $row['post_content'];
                            echo $blobpost;
                        ?>
                    </label><br><br>
                    <a href="Uploads/<? echo $postid ?>/<? echo $row['post_attachment'] ?>">Download attachment</a>
                    <br><br>

                    <label > <? echo $name ?> </label>
                    <label class = "w3-right" > <? echo $row['post_date'] ?></label>

                </div>
</div>

<br>

<div class="container">

    <form class="form " style="margin-left:25%; margin-right:25%;" action="includes/reply.php" method="post" enctype="multipart/form-data" autocomplete="off">

        <br>
        <header style="letter-spacing: 4px;" class="w3-select w3-center"> Create a reply </header>
        <br>

<?php

if (isset($_SESSION['user'])) { ?>

        <textarea style="max-width: 100%; min-width: 100%;" rows="2" cols="100" class="w3-select" type="text" placeholder="Enter reply" name="reply_content" required></textarea><br>

        <br>

        <input type="hidden" id="postid" name="postid" value="<? echo $postid ?>">

        <input type="submit" value="reply" name="reply" class="w3-btn w3-light-grey w3-animate-opacity">

        <? } else { ?>
    <div style="letter-spacing: 4px;" class="w3-center">
        <label> You must be logged in to reply to posts </label>
        <br>
        <a href="..#login">Log in here</a>
    </div>

<? } ?>

    </form>

</div>



<!-- display replies -->

<br>
<header style="letter-spacing: 4px;" class="w3-select w3-center"> Replies </header>

<br>

<?php

$sql = "SELECT reply_id, reply_content, reply_date, reply_post, reply_by FROM replies";
$result = mysqli_query($conn, $sql);


if (mysqli_num_rows($result) > 0) {

?>

<div style="margin-left:25%; margin-right:25%; margin-top: 5%;">
    <table>

        <?

        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {

            // finding username for each user id of reply
            $reply_by = $row['reply_by'];

            $sql2 = "SELECT DISTINCT name FROM users WHERE id = '$reply_by' ";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
            $name = $row2['name']


            ?>


                <div style = "letter-spacing: 2px; border-bottom:1px solid #ccc ; padding-bottom: 0px; text-decoration: none;" >
                    <label class="">
                        <?php
                        $blobreply = $row['reply_content'];
                        echo $blobreply;
                        ?>
                    </label><br><br>
                    <label class=""> <? echo $name ?> </label>
                    <label class = "w3-right" > <? echo $row['reply_date'] ?></label>
                    <br>
                </div>
                <br><br>

            <?

        }
        } else {
            ?> <label style="letter-spacing: 2px; text-align: center;" class="w3-center"> There are currently no replies to this post, why not create one?</label> <br><br><?
        }
        ?>

