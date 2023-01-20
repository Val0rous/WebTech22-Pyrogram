<?php
require_once "bootstrap.php";

// Params for the Base Template
$templateParams["name"] = "home.php";
$templateParams["css"] = "home.css";
//$templateParams["js"] = "home.js";    //test purposes only

// to be set in the login page
$_SESSION["user"]["user_id"] = 1;
$_SESSION["user"]["user_image"] = "";
$_SESSION["user"]["user_name"] = "user_name";

// to erase
$text = "Lorem ipsum dolor sit amet, consectetur adipisci elit, sed do eiusmod tempor incidunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrum exercitationem ullamco laboriosam, nisi ut aliquid ex ea commodi consequatur. Duis aute irure reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint obcaecat cupiditat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";

//$templateParams["posts"] = $dbh->getRandomPosts(5, $templateParams["userID"]);        // test example
$templateParams["posts"] = array(array("user_image"=>"img/default_profile_pic.jpg",   // example
        "user_name"=>"Name", "date"=>"07/01/2023", "content"=>$text, "media"=>array("img/08.png"),
        "num_likes"=>10, "num_comments"=>5),
        array("user_image"=>"img/default_profile_pic.jpg",
        "user_name"=>"Name2", "date"=>"08/01/2023", "content"=>$text, "media"=>array("img/10.png"),
        "num_likes"=>123, "num_comments"=>45)
);

//test purposes, TODO: implement it better later on
//array_push($templateParams, $dbh->fetchPosts($_SESSION["user"]["user_id"]));

require "templates/base.php";