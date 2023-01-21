<?php
//debug
/*
error_reporting(E_ALL);
ini_set("display_errors", 1);
*/
require_once "bootstrap.php";

// Params for the Base Template
$templateParams["name"] = "home.php";
$templateParams["css"] = "home.css";
//$templateParams["js"] = "home.js";    //test purposes only

// to be set in the login page  //commented because it was overriding login values
//$_SESSION["user"]["user_id"] = 1;
//$_SESSION["user"]["user_image"] = "";
//$_SESSION["user"]["user_name"] = "user_name";

// to erase
$text = "Lorem ipsum dolor sit amet, consectetur adipisci elit, sed do eiusmod tempor incidunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrum exercitationem ullamco laboriosam, nisi ut aliquid ex ea commodi consequatur. Duis aute irure reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint obcaecat cupiditat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";

//$templateParams["posts"] = $dbh->getRandomPosts(5, $_SESSION["user"]["user_id"]);     // test example
$templateParams["posts"] = array(array(/*"user_picture_path"=>"img/default_profile_pic.jpg",*/     // example
        /*"user_name"=>"Name", */"post_time"=>"07/01/2023", "content"=>$text, "media_path0"=>"img/08.png",
        "num_likes"=>10, "num_comments"=>5, "user_id" => "valent"),
        array(/*"user_picture_path"=>"img/default_profile_pic.jpg",*/
        /*"user_name"=>"Name2", */"post_time"=>"08/01/2023", "content"=>$text, "media_path0"=>"img/10.png",
        "num_likes"=>123, "num_comments"=>45, "user_id" => "valent")
);
//Ehi Fede fai il login nell'utente "valent" se vuoi testarlo, tanto la password è "password" lol

//test purposes, TODO: implement it better later on
//$db = new DatabaseHelper();
//array_push($templateParams, $dbh->fetchPosts($_SESSION["user"]["user_id"]));

//test purposes only, TODO: remove this once website finished
$db = new DatabaseHelper();
$posts = $db->findAllPosts("valent");
foreach ($posts as $post) {
    array_push($templateParams["posts"], $post);
}

require "templates/base.php";