<?php
session_start();
include 'includes/header.php';
include 'includes/connect.php';

if (isset($_SESSION['user'])) {
    include 'navbar_loggedin.php';
} else {
    include 'navbar_loggedout.php';
}
?>

<body>
<h3 class="w3-center " style="margin-top: 5%;  font-family: 'Times New Roman', Times, serif; letter-spacing: 2px;">
    Recent posts
</h3>

<!-- displaying posts -->
<?php
$sql = "SELECT post_id, post_title, post_date, post_user FROM posts ORDER BY post_date DESC";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
?>

<div style="margin-left:25%; margin-right:25%; margin-top: 5%; margin-bottom: 5%;">
    <table>
        <?
        // output data of each row
        while ($row = mysqli_fetch_assoc($result)) {

            // finding username for each user id of poster
            $post_user = $row['post_user'];
            $sql2 = "SELECT DISTINCT name FROM users WHERE id = '$post_user' ";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
            $name = $row2['name'];
            ?>

            <a href="postpage.php?postid=<? echo $row['post_id']; ?>" style="text-decoration: none;">
                <div style="letter-spacing: 2px; border-bottom:1px solid #ccc ; padding-bottom: 0px;">
                    <label class=""> <? echo $row['post_title'] ?></label><br><br>
                    <label class=""> <? echo $name ?> </label>
                    <label class="w3-right"> <? echo $row['post_date'] ?></label>
                    <br>
                </div>
                <br><br>
            </a>

            <?
        }
        } else {
            echo "currently no posts";
        }
        ?>
    </table>
</div>
</body>

