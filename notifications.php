<?php
require_once "bootstrap.php";

// Params for the Base Template
$templateParams["name"] = "notifications.php";
$templateParams["css"] = "notifications.css";
$templateParams["js"] = "follow_unfollow.js";

$db = new DatabaseHelper();
$templateParams["notifications"] = $db->fetchAllNotifications($_SESSION["user"]["user_id"]);
/*
array_push($templateParams["notifications"],    //example
    array("user_image" => "img/default_profile_pic.jpg",
        "content" => " liked your post.",
        "sender" => "Name",
        "type" => "like",
        "user_id" => ""),
    array("user_image" => "img/default_profile_pic.jpg",
        "content" => " commented your post.",
        "sender" => "Name2",
        "type" => "comment", "user_id" => ""),
    array("user_image" => "img/default_profile_pic.jpg",
        "content" => " started following you.",
        "sender" => "Name3",
        "type" => "follow", "user_id" => "")
);
*/

require "templates/base.php";