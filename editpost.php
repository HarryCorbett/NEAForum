<?php

session_start();
include 'includes/connect.php';
include 'includes/header.php';

if (isset($_SESSION['user'])) {
    include 'navbar_loggedin.php';
} else {
    include 'navbar_loggedout.php';
}

$postid = $_GET['postid'];

$sql = "SELECT post_title,post_content FROM posts WHERE post_id = $postid";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$blob = $row['post_content'];
$title = $row['post_title'];


?>

<body>


<div class="container" style="margin-left:30%; margin-right:30%;">

    <form class="form "  action="includes/editpost.inc.php?postid=<? echo $postid ?>" method="post" enctype="multipart/form-data" autocomplete="off">

        <br>
        <header style="letter-spacing: 4px;" class="w3-select w3-center"> Edit a post </header>
        <br>

        <label for="title" class="w3-wide w3-left" style="letter-spacing: 2px;">Title</label>
        <input class="w3-select" type="text" placeholder="Title" value="<? echo $title ?>" name="title" required>

        <br><br>

        <label for="content" class="w3-wide w3-left" style="letter-spacing: 2px;">Content</label>
        <textarea style="max-width: 100%; min-width: 100%;" rows="5" cols="100" class="w3-select" type="text" placeholder="Enter post content" name="content" required><? echo $blob ?></textarea><br>

        <br>

        <label for="tags" class="w3-wide w3-left" style="letter-spacing: 2px;">Tags and attachments cannot be edited at this time</label><br>

        <br><br>
        <input type="submit" value="update" name="edit" class="w3-btn w3-light-grey w3-animate-opacity">

        <a href="postpage.php?postid=<? echo $postid ?>"  class="w3-btn w3-light-grey w3-animate-opacity w3-right">Cancel</a>

    </form>


</div>

</body>

