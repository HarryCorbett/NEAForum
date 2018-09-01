<head>
    <link rel="Stylesheet" type="text/css" href="css/app.css"/>
</head>

<body>

<?php

session_start();
include 'includes/connect.php';

if (isset($_SESSION['user'])) {
    include 'navbar_loggedin.php';
} else {
    include 'navbar_loggedout.php';
}
?>


<title>Education Forum</title>

<br>


<!-- displaying posts -->
<?php

$sql = "SELECT post_id, post_title, post_date, post_user FROM posts";
$result = mysqli_query($conn, $sql);


if (mysqli_num_rows($result) > 0) {

    ?>

<div style="margin-left:25%; margin-right:25%; margin-top: 5%;">
    <table>

        <?

    // output data of each row
        while($row = mysqli_fetch_assoc($result)) {

            // finding username for each user id of poster
            $post_user = $row['post_user'];

            $sql2 = "SELECT DISTINCT name FROM users WHERE id = '$post_user' ";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
            $name = $row2['name']


            ?>


                <a href="postpage.php?postid=<? echo $row['post_id']; ?>" style="text-decoration: none;">
                <div style = "letter-spacing: 2px; border-bottom:1px solid #ccc ; padding-bottom: 0px;" >
                    <label class=""> <? echo $row['post_title'] ?></label><br><br>
                    <label class=""> <? echo $name ?> </label>
                    <label class = "w3-right" > <? echo $row['post_date'] ?></label>
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


<!-- left here temporarily, working on it in create post: -->
<br>
<form action="upload.php">
<label for="upload" class="w3-wide w3-left" style="letter-spacing: 2px;">Attachment ( doesn't currently work )</label><br>
<input  type="file" name="file"><br>
<button class="w3-btn w3-light-gray" type="submit" name="upload">Upload</button>
</form>

<!--<div>
    <!-- Download files
    <a href="Uploads/1/TestFile.pdf" download>Download here</a>

</div>
-->
</body>


<!-- Allows to scroll -->
<br><br><br><br><br><br>
<br><br><br><br><br><br>
<br><br><br><br><br><br>
<br><br><br><br><br><br>
<br><br><br><br><br><br>
<br><br><br><br><br><br>
<br><br><br><br><br><br>
<br><br><br><br><br><br>
<br><br><br><br><br><br>
<br><br><br><br><br><br>
