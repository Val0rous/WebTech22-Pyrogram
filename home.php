<?php
require_once "bootstrap.php";

// Params for the Base Template
$templateParams["name"] = "home.php";
$templateParams["css"] = "home_mobile.css";

// to be set in the sign in page
$templateParams["logged"] = true;
$templateParams["userID"] = 1;
$templateParams["profileImage"] = "";
$templateParams["profileName"] = "ProfileName";

//$templateParams["posts"] = $dbh->getRandomPosts(5, $templateParams["userID"]);        // test example
$templateParams["posts"] = array(array("profileImage"=>"img/default_profile_pic.jpg",   // example
        "profileName"=>"Name", "date"=>"07/01/2023", "content"=>"Some text", "media"=>array(""),
        "numLikes"=>10, "numComments"=>5));

require "templates/base.php";