<?php
require_once "bootstrap.php";

// Params for the Base Template
$templateParams["name"] = "home.php";
//$templateParams["posts"] = $dbh->getRandomPosts(5);  // Test: getting five random posts to put in the home
//$templateParams["posts"] = array(array("profileImage"=>"", "profileName"=>"Name",
        //"date"=>"07/01/2023", "content"=>"Some text", "numLikes"=>10, "numComments"=>5));       // example

require "templates/base.php";
