<?php
require_once "bootstrap.php";

// Params for the Base Template
$templateParams["name"] = "view_post.php";
$templateParams["css"] = "home.css";
$templateParams["js"] = "post.js";

$db = new DatabaseHelper();
$templateParams["post"] = $db->findPost($_GET["post"]);

require "templates/base.php";
