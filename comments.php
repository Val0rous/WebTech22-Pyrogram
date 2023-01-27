<?php
require_once "bootstrap.php";

// Params for the Base Template
$templateParams["name"] = "comments.php";
$templateParams["css"] = "comments.css";

$db = new DatabaseHelper();

// (home / view_post / profile / user_profile) post.php will pass post_id via GET function using URL query
$templateParams["post"] = $db->findPost($_GET["post"]);

require "templates/base.php";