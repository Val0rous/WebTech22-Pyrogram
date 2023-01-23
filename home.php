<?php
//debug
/*
error_reporting(E_ALL);
ini_set("display_errors", 1);
*/
require_once "bootstrap.php";

// Params for the Base Template
$templateParams["name"] = "home.php";
$templateParams["css"] = "home.css";
$templateParams["js"] = "home.js";

//New and hopefully final version
$db = new DatabaseHelper();
$templateParams["posts"] = $db->fetchPosts($_SESSION["user"]["user_id"]);

require "templates/base.php";