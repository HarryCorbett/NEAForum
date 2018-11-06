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

<title>Education Forum</title>

<body>

<h3 class = "w3-center " style="margin-top: 5%;  font-family: 'Times New Roman', Times, serif; letter-spacing: 2px;">
    Search results
</h3>

<div style="margin-left:25%; margin-right:25%; margin-top: 5%; margin-bottom: 5%;">

<?

$usersearch = $_GET['usersearch'];
$tagsearch = $_GET['tagsearch'];
$questionsearch = $_GET['questionsearch'];

$usersearch = trim($usersearch,"' ', ''" );
$tagsearch = trim($tagsearch,"' ', ''" );
$questionsearch = trim($questionsearch,"' ', ''" );


    $sql = "SELECT DISTINCT posts.post_id FROM posts 
            LEFT JOIN users ON posts.post_user = users.id 
            LEFT JOIN posttags ON posts.post_id = posttags.post_id
            LEFT JOIN tags ON posttags.tag_id = tags.tag_id  
            WHERE posts.post_title LIKE '$questionsearch' OR users.name = '$usersearch' OR tags.tag_name LIKE '$tagsearch'
            ORDER BY posts.post_date DESC";


    $result = mysqli_query($conn, $sql);
    $postids = mysqli_fetch_array($result,MYSQLI_ASSOC);

    if (mysqli_num_rows($result) > 0) {
        foreach($result as $postids){
            foreach($postids as $postid){

            $getpostinfo = "SELECT post_title, post_date, post_user FROM posts WHERE post_id = $postid";
            $postinfo = mysqli_query($conn,$getpostinfo);
            $row = mysqli_fetch_array($postinfo, MYSQLI_ASSOC);


                // Fetching username
                $postuser = $row['post_user'];

                $getusername = "SELECT DISTINCT name FROM users WHERE id = '$postuser'";
                $name = mysqli_query($conn, $getusername);
                $namerow = mysqli_fetch_array($name,MYSQLI_ASSOC);
                $name = $namerow['name'];


                ?>
                <a href="postpage.php?postid=<? echo $postid; ?>" style="text-decoration: none;">
                    <div style="letter-spacing: 2px; border-bottom:1px solid #ccc ; padding-bottom: 0;">
                        <label class=""> <? echo $row['post_title'] ?></label><br><br>
                        <label class=""> <? echo $name ?> </label>
                        <label class="w3-right"> <? echo $row['post_date'] ?></label>
                        <br>
                    </div>
                    <br><br>
                </a>
                <?
            }}
    }else {

                ?> <label style="letter-spacing: 2px; border-bottom:1px solid #ccc ; padding-bottom: 0;">Your search found
                    no results</label>  <?
            }
        ?>

</div>

</body>