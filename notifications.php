<?php
require_once "bootstrap.php";

// Params for the Base Template
$templateParams["name"] = "notifications.php";
$templateParams["css"] = "notifications.css";
// notification type images
$templateParams["notification_type"]["like"]["img"] = "image-icon.jpg";
$templateParams["notification_type"]["like"]["alt"] = "post";
$templateParams["notification_type"]["comment"]["img"] = "image-icon.jpg";
$templateParams["notification_type"]["comment"]["alt"] = "post";
/*$templateParams["notification_type"]["follow"]["img"]["yes"] = "";          // ?
$templateParams["notification_type"]["follow"]["alt"]["yes"] = "following"; // ?
$templateParams["notification_type"]["follow"]["img"]["no"] = "";           // ?
$templateParams["notification_type"]["follow"]["alt"]["no"] = "follow";     // ?*/

//$templateParams["notifications"] = $dbh->getUserNotifications($_SESSION["user"]["user_id"]);  // test example
$templateParams["notifications"] = array(array("user_image"=>"img/default_profile_pic.jpg",     // example
        "user_name"=>"Name", "content"=>"liked your post.", "type"=>"like", "user_id"=>""),
        array("user_image"=>"img/default_profile_pic.jpg",
        "user_name"=>"Name2", "content"=>"commented your post.", "type"=>"comment", "user_id"=>""),
        array("user_image"=>"img/default_profile_pic.jpg",
        "user_name"=>"Name3", "content"=>"started following you.", "type"=>"follow", "user_id"=>"")
);

require "templates/base.php";