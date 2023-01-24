<?php
require_once "bootstrap.php";

if (isset($_COOKIE["user"]) and
    isset($_COOKIE["token"])) {
    $db = new DatabaseHelper();
    $_SESSION["user"] = $db->findUser($_COOKIE["user"]);
    //require "home.php";
    header("Location: home.php", TRUE, 301);
} else {
    //require "login.php";
    header("Location: login.php", TRUE, 301);
}
exit();
