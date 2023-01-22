<?php
require_once "bootstrap.php";

// Params for the Base Template
$templateParams["name"] = "notifications.php";
$templateParams["css"] = "notifications.css";

/*
// notification type images
$templateParams["notification_type"]["like"]["img"] = "image-icon.jpg";
$templateParams["notification_type"]["like"]["alt"] = "post";
$templateParams["notification_type"]["comment"]["img"] = "image-icon.jpg";
$templateParams["notification_type"]["comment"]["alt"] = "post";

//pasting it here from templates/notifications.php, in <?php else: ?>
<img src="img/<?=$templateParams["notification_type"][$notification["type"]]["img"]?>"
                     alt="<?=$templateParams["notification_type"][$notification["type"]]["alt"]?>"/>
*/

/*$templateParams["notification_type"]["follow"]["img"]["yes"] = "";          // ?
$templateParams["notification_type"]["follow"]["alt"]["yes"] = "following"; // ?
$templateParams["notification_type"]["follow"]["img"]["no"] = "";           // ?
$templateParams["notification_type"]["follow"]["alt"]["no"] = "follow";     // ?*/

//$templateParams["notifications"] = $dbh->getUserNotifications($_SESSION["user"]["user_id"]);  // test example
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