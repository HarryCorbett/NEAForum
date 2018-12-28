<?php

session_start();
include 'includes/header.php';
include 'includes/connect.php';

if (isset($_SESSION['user'])) {
    include 'navbar_loggedin.php';
} else {
    include 'navbar_loggedout.php';
}

$usersearch = $_GET['usersearch'];
$tagsearch = $_GET['tagsearch'];
$questionsearch = $_GET['questionsearch'];
$sort = $_GET['sort'];

if(empty($sort)){
    $sort = 'time';
}

?>

<title>Education Forum</title>

<body>

<h3 class = "w3-center " style="margin-top: 5%;  font-family: 'Times New Roman', Times, serif; letter-spacing: 2px;">
    Search results
</h3>

<div class = "w3-left " id="sortingmethod" style="letter-spacing: 2px; padding-bottom: 0;margin-left:25%; margin-right:25%; margin-top: 5%;border-bottom: 1px solid #aaa; ">
    Sort by:
    <a href="searchresults.php?usersearch=<?echo $usersearch?>&tagsearch=<? echo $tagsearch ?>&questionsearch=<?echo $questionsearch?>&sort=time" class="w3-button" >Time posted</a>
    <a href="searchresults.php?usersearch=<?echo $usersearch?>&tagsearch=<? echo $tagsearch ?>&questionsearch=<?echo $questionsearch?>&sort=upvotes" class="w3-button" >Reply upvotes</a>


</div><br><br><br>

<div style="margin-left:25%; margin-right:25%; margin-top: 5%; margin-bottom: 5%;">

<?

$usersearch = trim($usersearch, "' ', ''");
$tagsearch = trim($tagsearch, "' ', ''");
$questionsearch = trim($questionsearch, "' ', ''");



    $emptysearchterm = "emptystringthatwontbeinatitle";
    if ($questionsearch == "") {
        $questionsearch = '%' . $emptysearchterm . '%';

    } else {

        $soundexquestion = "";
        $soundexpostids = array();

        $questionsarray = explode(" ", $questionsearch);

        foreach ($questionsarray as $word) {

            $soundexquestion = $soundexquestion . soundex($word) . " ";

        }

        $sql = "SELECT post_title FROM posts";
        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $title = $row['post_title'];
            $soundextitle = "";

            $newtitle = preg_replace("/(?![.=$'€%-])\p{P}/u", "", $title);

            $splittitle = explode(" ", $newtitle);

            foreach ($splittitle as $titlewords) {
                $soundextitle = $soundextitle . soundex($titlewords) . " ";
            }


            if (strpos($soundextitle, $soundexquestion) !== false) {

                $getid = "SELECT post_id FROM posts WHERE post_title = '$title'";
                $titleidresult = mysqli_query($conn, $getid);
                $titleidarray = mysqli_fetch_array($titleidresult, MYSQLI_ASSOC);

                foreach ($titleidarray as $titleid) {
                    array_push($soundexpostids, $titleid);

                }
            }
        }

        // -- Testing --
        //echo "title: " . $title;
        //echo "title: " . $newtitle;
        //echo "Soundex title: " . $soundextitle;
        //echo "Soundex question: " . $soundexquestion;
        //foreach ($soundexpostids as $id) {
        //    echo $id . " ";
        //}

    }

    $sql = "SELECT DISTINCT posts.post_id FROM posts 
            LEFT JOIN users ON posts.post_user = users.id 
            LEFT JOIN posttags ON posts.post_id = posttags.post_id
            LEFT JOIN tags ON posttags.tag_id = tags.tag_id  
            WHERE users.name = '$usersearch' OR tags.tag_name LIKE '$tagsearch'
            ORDER BY posts.post_date DESC";

    $result = mysqli_query($conn, $sql);
    $postids = mysqli_fetch_array($result, MYSQLI_ASSOC);

    $finalpostids = array();

    foreach ($result as $postids) {
        foreach ($postids as $postid) {
                if(!in_array($postid,$finalpostids)){
                    array_push($finalpostids,$postid);
                }
        }
    }

    foreach($soundexpostids as $postid){
            if(!in_array($postid,$finalpostids)){
                array_push($finalpostids, $postid);
            }
    }




    function printposts($finalpostids,$conn){

        foreach($finalpostids as $postid){

            $getpostinfo = "SELECT post_title, post_date, post_user FROM posts WHERE post_id = $postid";
            $postinfo = mysqli_query($conn, $getpostinfo);
            $row = mysqli_fetch_array($postinfo, MYSQLI_ASSOC);


            // Fetching username
            $postuser = $row['post_user'];

            $getusername = "SELECT DISTINCT name FROM users WHERE id = '$postuser'";
            $name = mysqli_query($conn, $getusername);
            $namerow = mysqli_fetch_array($name, MYSQLI_ASSOC);
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
        }


}


// ---------------------------- //


if($sort == 'time') {


    if (count($finalpostids) > 0) {

        printposts($finalpostids,$conn);

    } else {
        ?> <label style="letter-spacing: 2px; border-bottom:1px solid #ccc ; padding-bottom: 0;">Your search found no results</label> <?
    }


// ---------------------------- //


}elseif($sort = "upvotes") {

    if (count($finalpostids) > 0) {

        $upvotes = array();

        foreach ($finalpostids as $postid) {
            $sql = "SELECT SUM(value) AS upvotes FROM votes,replies,posts WHERE votes.reply_id = replies.reply_id AND replies.reply_post = posts.post_id AND posts.post_id = '$postid' ";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result);
            $value = $row['upvotes'];
            if ($value == null) {
                $upvotes[$postid] = 0;
            } else {
                $upvotes[$postid] = $value;
            }
        }



        // ----- Merge Sort -----

        function mergesort($array)
        {
            if (count($array) == 1) {
                return $array;
            }
            $len = count($array);

            // Split arrays
            $lefthalf = array_slice($array, 0, $len / 2);
            $righthalf = array_slice($array, $len / 2);

            //recursive loop to keep splitting
            $lefthalf = mergesort($lefthalf);
            $righthalf = mergesort($righthalf);

            // gradually combine the arrays into one ordered array
            return mergearrays($lefthalf, $righthalf);

        }

        function mergearrays($lefthalf, $righthalf)
        {

            // array to  add to
            $temp = array();


            while (count($lefthalf) > 0 and count($righthalf) > 0) {

                if ($lefthalf[0] > $righthalf[0]) {
                    $temp[] = $righthalf[0];
                    $righthalf = array_slice($righthalf, 1);

                } else {
                    $temp[] = $lefthalf[0];
                    $lefthalf = array_slice($lefthalf, 1);
                }
            }
            // add all of remaining left to array
            while (count($lefthalf) > 0) {
                $temp[] = $lefthalf[0];
                $lefthalf = array_slice($lefthalf, 1);
            }
            // add all of remaining right to array
            while (count($righthalf) > 0) {
                $temp[] = $righthalf[0];
                $righthalf = array_slice($righthalf, 1);
            }
            return $temp;
        }

        $sortedarray = mergesort($upvotes);

        $finalpostids = array();
        $checkarray = $upvotes;

        foreach($sortedarray as $upvoteval){
            $key = array_search($upvoteval, $checkarray);
            array_push($finalpostids,$key);
            unset($checkarray[$key]);
        }

        $finalpostids = array_reverse($finalpostids);

        printposts($finalpostids,$conn);

    } else {
        ?> <label style="letter-spacing: 2px; border-bottom:1px solid #ccc ; padding-bottom: 0;">Your search found no
            results</label> <?
    }


}
?>

</div>

</body>