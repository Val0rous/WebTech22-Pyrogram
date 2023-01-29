<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once "bootstrap.php";
$db = new DatabaseHelper();
$templateParams["name"] = "view_list.php";
$templateParams["css"] = array("comments.css", "search.css");
$templateParams["js"] = "follow_following.js";

switch ($_GET["type"]) {
    case "likes":
        $list = $db->findAllLikes($_GET["post"]);
        $header = "Likes";
        break;
    case "followers":
        $list = $db->findAllFollowers($_GET["user"]);
        $header = "Followers";
        break;
    case "following":
        $list = $db->findAllFollowings($_GET["user"]);
        $header = "Following";
        break;
    case "tags":
        $list = $db->findAllTags($_GET["post"]);
        $header = "Tags";
        break;
}

$templateParams["list"] = $list;
$templateParams["header"] = $header;
require "templates/base.php";