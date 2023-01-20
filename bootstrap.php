<?php
if (!session_id()) {
    session_start();
}
require_once "db/DatabaseHelper.php";
const UPLOAD_DIR = "db/media";
$dbh = new DatabaseHelper();

//require_once("utils/functions.php");
/*
if(!isset($_SESSION["db"])) {
    $db = new DatabaseHelper();
    $_SESSION["db"] = $db;
}
*/
//echo $_SERVER['DOCUMENT_ROOT'];
