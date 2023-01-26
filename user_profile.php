<?php
require_once "bootstrap.php";

// Params for the Base Template
$templateParams["name"] = "user_profile.php";
$templateParams["css"] = "user_profile.css";
$templateParams["js"] = array("post.js", "follow_following.js");

$db = new DatabaseHelper();
if (isset($_GET["user"])) {
    $templateParams["posts"] = $db->findAllPosts($_GET["user"]);
}

require "templates/base.php";
