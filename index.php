<head>
    <link rel="Stylesheet" type="text/css" href="css/app.css"/>
</head>

<body>

<?php
session_start();
if (isset($_SESSION['user'])) {
    include 'navbar_loggedin.php';
} else {
    include 'navbar_loggedout.php';
}
?>


<title>Education Forum</title>

<br>
<!-- input files -->
<!-- Notes: enctype specifies how form data should be encoded -->

<div>

    <form action="upload.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="file">
        <button class="upload w3-btn w3-blue" type="submit" name="submit">Upload</button>

    </form>
    <!-- Download files -->
    <a href="Uploads/1/TestFile.pdf" download>Download here</a>

</div>

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
