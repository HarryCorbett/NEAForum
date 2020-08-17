<?php
session_start();
include 'includes/connect.php';
include 'includes/header.php';

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
            $postid = $_GET['postid'];
        }

        $sql = "SELECT * FROM posts WHERE post_id = '$postid' ";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        // finding username for user id of poster
        $post_user = $row['post_user'];
        $sql2 = "SELECT DISTINCT name FROM users WHERE id = '$post_user' ";
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
        $name = $row2['name'];
        ?>

        <div style="letter-spacing: 2px; border-bottom:1px solid #ccc ; padding-bottom: 0px;">

            <label> <? echo $name ?> </label>
            <br>
            <label class="w3-tiny"> Posted: <? echo $row['post_date'] ?></label>
            <br><br>
            <label style="font-weight: bold;"> <? echo $row['post_title'] ?></label><br><br>
            <label>
                <?php
                $blobpost = $row['post_content'];
                echo $blobpost;
                ?>
            </label><br><br>
            <label> Attachment:</label><br>
            <a href="Uploads/<? echo $postid ?>/<? echo $row['post_attachment'] ?>"> <? echo $row['post_attachment_name'] ?></a><br>

            <label>Tags:</label><br>
            <?php
            $tagidarray = array();
            //fetch tags
            $tagidsquery = mysqli_query($conn, "SELECT tag_id FROM posttags WHERE posttags.post_id = $postid");
            while ($row = mysqli_fetch_array($tagidsquery)) {
                $tagidarray[] = $row['tag_id'];
            }

            if (!empty($tagidarray)) {
                foreach ($tagidarray as $tagid) {
                    $tagquery = mysqli_query($conn, "SELECT DISTINCT tag_name FROM tags where tag_id = $tagid");
                    $tagarray = mysqli_fetch_array($tagquery, MYSQLI_ASSOC);
                    $tag = $tagarray['tag_name'];
                    echo '#' . $tag . " ";
                }
            } else {
                echo 'This post has no tags';
            }

            if ($post_user == $_SESSION['user']) {
                ?>
                <a class="fas fa-trash-alt fa-1.5x w3-right w3-text-grey"
                   href="includes/deletepost.php?postid=<? echo $postid ?>"></a>
                <a class="fas fa-edit fa-1.5x w3-right w3-text-grey" href="editpost.php?postid=<? echo $postid ?>"></a>
                <br>
            <? } ?>
        </div>
</div>

<div class="container">

    <form class="form " style="margin-left:25%; margin-right:25%;" action="includes/reply.php" method="post"
          enctype="multipart/form-data" autocomplete="off">
        <br>
        <header style="letter-spacing: 4px;" class="w3-select w3-center w3-large"> Create a reply</header>
        <br>
        <?php
        if (isset($_SESSION['user'])) { ?>

            <textarea style="max-width: 100%; min-width: 100%;" rows="2" cols="100" class="w3-select" type="text"
                      placeholder="Enter reply" name="reply_content" required></textarea><br>
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
<header style="letter-spacing: 4px;" class="w3-select w3-center w3-large"> Replies</header>
<br>
<?php

$sql = "SELECT replies.reply_id, replies.reply_by, replies.reply_date, replies.reply_content,  SUM(votes.value) AS score
        FROM replies LEFT JOIN votes ON replies.reply_id = votes.reply_id WHERE replies.reply_post = $postid GROUP BY reply_id ORDER BY SUM(votes.value) DESC";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result2, MYSQLI_ASSOC);
if (mysqli_num_rows($result) > 0) {
?>

<div style="margin-left:25%; margin-right:25%; margin-top: 5%;">
    <table>
        <?
        // output data of each row
        while ($row = mysqli_fetch_assoc($result)) {
            // finding username for each user id of reply
            $reply_by = $row['reply_by'];
            $sql2 = "SELECT DISTINCT name FROM users WHERE id = '$reply_by' ";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
            $name = $row2['name'];
            $repquery = "SELECT SUM(value) AS rep FROM votes,replies WHERE replies.reply_id = votes.reply_id AND replies.reply_by = '$reply_by'";
            $fetchrep = mysqli_query($conn, $repquery);
            $reprow = mysqli_fetch_array($fetchrep, MYSQLI_ASSOC);
            $rep = $reprow['rep'];

            if (empty($rep)) {
                $rep = '0';
            }
            ?>

            <div style="letter-spacing: 2px; border-bottom:1px solid #ccc ; padding-bottom: 0px; text-decoration: none;">
                <label class=""><? echo $name ?> </label><label class="w3-small">reputation: <? echo $rep ?></label>
                <br>
                <label class="w3-tiny"> Replied at:<? echo $row['reply_date'] ?></label>
                <br><br>
                <label>
                    <?php
                    $blobreply = $row['reply_content'];
                    echo $blobreply;
                    ?>
                </label><br><br>
                <?php
                if (isset($_SESSION['user'])) {

                    $sessionuser = $_SESSION['user'];
                    $replyid = $row['reply_id'];
                    $sql3 = "SELECT value from votes where user_id = $sessionuser and reply_id = $replyid";
                    $result3 = mysqli_query($conn, $sql3);
                    $rowcount = mysqli_num_rows($result3);

                    if ($rowcount != 0) {
                        $row3 = mysqli_fetch_array($result3, MYSQLI_ASSOC);
                        $value = $row3['value'];
                    } else {
                        $value = 0;
                    }

                    if ($value == 0) {
                        $upcol = "black";
                        $docol = "black";
                    } elseif ($value == 1) {
                        $upcol = "#00cdfe";
                        $docol = "black";
                    } elseif ($value == -1) {
                        $upcol = "black";
                        $docol = "#00cdfe";
                    }

                    if ($row['reply_by'] != $_SESSION['user']) { ?>

                        <div class="w3-center">
                            <a href="includes/choosefunction.php?upordown=1&value=<? echo $value ?>&replyid=<? echo $row['reply_id']; ?>&postid=<? echo $postid ?>"
                               class="w3-small , fas fa-chevron-up"
                               style="color:<? echo $upcol ?>; background: transparent; border: none !important; outline:none; cursor: pointer; text-decoration: none;"
                               id="upvote"></a>
                            <label> Score: <?php echo 0 + $row['score']; ?></label>
                            <a href="includes/choosefunction.php?upordown=-1&value=<? echo $value ?>&replyid=<? echo $row['reply_id']; ?>&postid=<? echo $postid ?>"
                               class="w3-small , fas fa-chevron-down"
                               style="color:<? echo $docol ?>; background: transparent; border: none !important; outline:none; cursor: pointer; text-decoration: none;"
                               id="downvote"></a>
                        </div>

                    <? } else { ?>
                        <div class="w3-center">
                            <label> Score: <?php echo 0 + $row['score']; ?></label>
                            <a class="fas fa-trash-alt w3-right w3-small w3-text-grey"
                               href="includes/deletereply.php?replyid=<? echo $replyid ?>&postid=<? echo $postid ?>"></a>
                        </div>
                    <? }
                } else {
                    ?>
                    <div class="w3-center">
                        <label> Score: <?php echo 0 + $row['score']; ?></label> <br>
                        <a class="w3-small" href="..#login"> Please login to vote on replies </a>
                    </div>
                    <?
                } ?>
            </div>
            <br><br>
            <?
        }
        } else {
            ?>
            <div class="w3-center">
                <label style="letter-spacing: 2px; text-align: center;" class="w3-center"> There are currently no
                    replies to this post, why not create one?</label> <br><br>
            </div>
            <?
        }
        ?>
