<head>
    <link rel="Stylesheet" type="text/css" href="css/app.css"/>
</head>

<body>

<?php

session_start();
include 'connect.php';

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


<?php

$sql = "SELECT post_title, post_content, post_date, post_by FROM posts;";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {

    ?>

<div name="posts" style="margin-left:30%; margin-right:30%;">
    <table>
        <tr>
            <th style="width: 2% ;">Title</th>
            <th>Content</th>
            <th>Date</th>
            <th>By</th>
        </tr>

        <?

    // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            echo "<tr><td>" . $row['post_title'] . "</td><td>" . $row['post_content'] . "</td><td>" . $row['post_date'] . "</td><td>" . $row['post_content'] . "</td></tr>"; ?><br><?
            echo "</table>";
    }
} else {
    echo "currently no posts";
}
?>
</table>
</div>

<!-- echo " " . $row["title"]. " - contents: " . $row["contents"]. " <br>";

<!-- left here temporarily, working on it in create post:

<label for="upload" class="w3-wide w3-left" style="letter-spacing: 2px;">Attachment</label><br>
<input class="w3-select" type="file" name="file"><br>
<!--<button class="upload w3-btn w3-light-gray w3-select" type="submit" name="submit">Upload</button>
    button not needed but left for now until i move the contents of upload to run when the form is submitted
    need to add attachment name to database

<div>
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
