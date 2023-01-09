<?php
require_once "db/DatabaseHelper.php";

if (isset($_POST["username_email"]) and
    isset($_POST["password"])) {
    $db = new DatabaseHelper();
    if (($user = $db->findLogin($_POST["username_email"], $_POST["password"])) !== null) {
        $_SESSION["user"] = $user;
        require "home.php";
    } else {
        require "login.php";
    }
} else {
    require "login.php";
}
