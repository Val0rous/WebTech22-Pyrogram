<?php
require_once "bootstrap.php";

// Params for the Base Template
$templateParams["name"] = "notifications.php";
$templateParams["css"] = "notifications.css";
$templateParams["js"] = "follow_unfollow.js";

$db = new DatabaseHelper();
$templateParams["notifications"] = $db->fetchAllNotifications($_SESSION["user"]["user_id"]);

require "templates/base.php";