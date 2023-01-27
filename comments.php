<?php
require_once "bootstrap.php";

// Params for the Base Template
$templateParams["name"] = "comments.php";
$templateParams["css"] = "comments.css";    //not created yet
$templateParams["js"] = "comments.js";

$db = new DatabaseHelper();
//view_post or home will pass post_id via GET function using URL query
$templateParams["post"] = $db->findPost($_GET["post"]);

require "templates/base.php";