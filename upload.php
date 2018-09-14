<?php

/* temp for having files organised */
$postid = 1;

if (isset($_POST['upload'])) {
    $file = $_FILES['file'];

    $fileName = $_FILES['file']['name'];

    /* temp file storage */
    $fileTempName = $_FILES['file']['tmp_name'];

    /* check file size */
    $fileSize = $_FILES['file']['size'];

    /* check for error */
    $fileError = $_FILES['file']['error'];

    /* check file type */
    $fileType = $_FILES['file']['type'];

    echo $postid . "<br>";
    echo $fileName . "<br>";
    echo $fileSize . "<br>";
    echo $fileError . "<br>";
    echo $fileType . "<br>";

    /* Gets file name and extension separately */
    $fileExt = explode("/", $fileType);

    /* Sets the file extension (the end section of explode function array) to lower case */
    $fileActualExt = strtolower(end($fileExt));

    echo "File type: " . $fileActualExt . "<br>";

    /* setting allowed files */
    $allowed = array("jpg", "jpeg", "png", "pdf");

    /* checks the file type is allowed */
    if (in_array($fileActualExt, $allowed)) {

        /* checks there are no errors in uploading */
        if ($fileError === 0 ) {
            /* file no larger than n Kb */
            if ($fileSize < 500000) {

                /*making a file for that post*/
                if(mkdir("Uploads/" . $postid)) {
                    echo "created successfully";}

                /* set to unique id for the file */
                $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                $fileDestination = 'Uploads/' . $postid . '/' . $fileNameNew;

                move_uploaded_file($fileTempName, $fileDestination);

                header("location: ");

            } else {
                echo "The file is too large";
            }
        } else {
            echo "There was an error uploading the file";
        }
    } else {
        echo "You cannot upload files of this type";
    }
}

/*https://youtu.be/JaRq73y5MJk*/