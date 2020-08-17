<?php
include 'connect.php';

session_start();
$_SESSION['postmessage'] = '';

$title = mysqli_real_escape_string($conn, $_POST['title']);
$content = mysqli_real_escape_string($conn, $_POST['content']);
$tagsinput = mysqli_real_escape_string($conn, $_POST['tags']);
$user = $_SESSION['user'];

$sql = "INSERT INTO posts (post_title,post_content,post_date,post_user)
        values ('$title','$content',NOW(),'$user')";

if (mysqli_query($conn, $sql)) {

    if (isset($tagsinput)) {
        $sqlpostid = "SELECT post_id FROM posts ORDER BY post_id DESC LIMIT 1";
        $newpostidrow = mysqli_query($conn, $sqlpostid);
        $row = mysqli_fetch_array($newpostidrow, MYSQLI_ASSOC);
        $newpostid = $row['post_id'];

        // separating tags into individual string
        $tagstripcommas = explode(",", $tagsinput);
        foreach ($tagstripcommas as $value) {

            $value = str_replace(" ", "", $value);
            $result = mysqli_query($conn, "SELECT * FROM tags WHERE tag_name = '$value'");

            if (mysqli_num_rows($result) == 0) {
                mysqli_query($conn, "INSERT INTO tags (tag_name) VALUES ('$value')");
                $newtagtidrow = mysqli_query($conn, "SELECT tag_id FROM tags ORDER BY tag_id DESC LIMIT 1");
                $row2 = mysqli_fetch_array($newtagtidrow, MYSQLI_ASSOC);
                $tagid = $row2['tag_id'];
            } else {
                $row3 = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $tagid = $row3['tag_id'];
            }
            mysqli_query($conn, "INSERT INTO posttags VALUES ('$tagid','$newpostid')");
        }
    }

    $sql2 = "SELECT post_id from posts where post_date = (SELECT max(post_date) from posts) ";
    $result = mysqli_query($conn, $sql2);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $postid = $row['post_id'];

    echo $postid; ?> <br> <?

    if ($_FILES['file']['name'] !== "") {

        $file = $_FILES['file'];
        $fileName = $_FILES['file']['name'];
        $fileTempName = $_FILES['file']['tmp_name'];
        $fileSize = $_FILES['file']['size'];
        $fileError = $_FILES['file']['error'];
        $fileType = $_FILES['file']['type'];

        /* Gets file name and extension separately */
        $fileExt = explode("/", $fileType);
        $fileExtLower = strtolower(end($fileExt));

        /* setting allowed files */
        $allowed = array("jpg", "jpeg", "png", "pdf", "txt");

        /* checks the file type */
        if (in_array($fileExtLower, $allowed)) {

            if ($fileError === 0) {
                /* file no larger than set value in bytes */
                if ($fileSize < 5000000) {

                    /*making a file for that post*/
                    if (mkdir("../Uploads/" . $postid)) {
                        echo "created successfully";
                    }
                    /* set to unique id for the attachment */
                    $fileNameNew = uniqid('', true) . "." . $fileExtLower;
                    $fileDestination = '../Uploads/' . $postid . '/' . $fileNameNew;

                    move_uploaded_file($fileTempName, $fileDestination);
                    $sql3 = "UPDATE posts SET post_attachment = '$fileNameNew', post_attachment_name = '$fileName' where post_id = '$postid'";

                    if (mysqli_query($conn, $sql3)) {
                        echo "hello";
                    }
                } else {
                    echo "The file is too large";
                    header("location: ../");
                }
            } else {
                echo "There was an error uploading the file";
                header("location: ../");
            }
        } else {
            echo "You cannot upload files of this type";
            header("location: ../");
        }
    }
    header("location: ../");
} else {
    $_SESSION['postmessage'] = 'Post could not be created';
    header("location: ../createpost.php#posterror");
}