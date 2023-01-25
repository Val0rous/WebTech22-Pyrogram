<?php
require_once "bootstrap.php";

// Params for the Base Template
$templateParams["name"] = "user_profile.php";
$templateParams["css"] = "profile.css";
$templateParams["js"] = "profile.js";

$db = new DatabaseHelper();
$templateParams["posts"] = $db->findAllPosts($_GET["user"]);

require "templates/base.php";
