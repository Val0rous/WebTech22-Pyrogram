<?php
if (!session_id()) {
    session_start();
}
require_once "db/DatabaseHelper.php";
const UPLOAD_DIR = "db/media";
define("ROOT", getcwd());
//require_once("utils/functions.php");
/*
if(!isset($_SESSION["db"])) {
    $db = new DatabaseHelper();
    $_SESSION["db"] = $db;
}
*/
//echo $_SERVER['DOCUMENT_ROOT'];
