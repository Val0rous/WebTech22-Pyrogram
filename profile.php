<?php
require_once "bootstrap.php";

// Params for the Base Template
$templateParams["name"] = "profile.php";
$templateParams["css"] = "profile.css";
$templateParams["js"] = "profile.js";

$db = new DatabaseHelper();
$templateParams["posts"] = $db->findAllPosts($_SESSION["user"]["user_id"]);

require "templates/base.php";
