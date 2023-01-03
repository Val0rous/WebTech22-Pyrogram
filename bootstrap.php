<?php
session_start();
require_once "home.php";
require_once "db/DatabaseHelper.php";
//define("UPLOAD_DIR", "./upload/");
//require_once("utils/functions.php");
////require_once("db/database.php");
$dbh = new DatabaseHelper();
echo $_SERVER['DOCUMENT_ROOT'];
