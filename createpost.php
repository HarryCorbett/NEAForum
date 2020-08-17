<?php
session_start();
include 'includes/header.php';

if (isset($_SESSION['user'])) {
    include 'navbar_loggedin.php';
} else {
    include 'navbar_loggedout.php';
}
?>

<body>
<div class="container">

    <form class="form " style="margin-left:30%; margin-right:30%;" action="includes/createpost.inc.php" method="post"
          enctype="multipart/form-data" autocomplete="off">

        <br>
        <header style="letter-spacing: 4px;" class="w3-select w3-center"> Create a post</header>
        <br>
        <label class="w3-center w3-red"><? echo $_SESSION['postmessage'] ?></label>
        <br>
        <label for="title" class="w3-wide w3-left" style="letter-spacing: 2px;">Title</label>
        <input class="w3-select" type="text" placeholder="Title" name="title" required>

        <br><br>
        <label for="content" class="w3-wide w3-left" style="letter-spacing: 2px;">Content</label>
        <textarea style="max-width: 100%; min-width: 100%;" rows="5" cols="100" class="w3-select" type="text"
                  placeholder="Enter post content" name="content" required></textarea><br>
        <br>
        <label for="tags" class="w3-wide w3-left" style="letter-spacing: 2px;">Tags</label><br>
        <label for="tags" class="w3-wide w3-left w3-tiny" style="letter-spacing: 2px;">Please enter tags without any
            symbols and with a comma between each tag</label>
        <input class="w3-select" type="text" placeholder="Tags" name="tags"><br>
        <br>

        <label for="upload" class="w3-wide w3-left" style="letter-spacing: 2px;">Attachment</label><br>
        <input class="w3-select" type="file" name="file">

        <br><br>
        <input type="submit" value="create" name="create" class="w3-btn w3-light-grey w3-animate-opacity">

    </form>

</div>
</body>
