<?php
require_once "bootstrap.php";

if (isset($_COOKIE["user"]) and
    isset($_COOKIE["token"])) {
    $_SESSION["user"] = $_COOKIE["user"];
    //require "home.php";
    header("Location: home.php", TRUE, 301);
} else {
    //require "login.php";
    header("Location: login.php", TRUE, 301);
}
exit();
