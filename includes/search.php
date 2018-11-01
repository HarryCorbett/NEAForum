<?php

$search = $_GET['search'];
$search = strtolower($search);

if (($pos = strpos($search,"@")) !== FALSE){
    $userafterat = substr($search, $pos+1);
    $usersearch = strtok($userafterat, " ");
}

if (($pos = strpos($search,"#")) !== FALSE){
    $tagafterhash = substr($search, $pos+1);
    $tagsearch= strtok($tagafterhash, " ");
}

$removechar = str_replace(array('@','#'),"",$search);
$question = str_replace(array($tagsearch,$usersearch),"",$removechar);

echo $usersearch; ?><br><?
echo $tagsearch;  ?><br><?
echo $question;

