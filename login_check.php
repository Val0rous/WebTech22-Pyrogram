<?php
require_once "db/DatabaseHelper.php";

if (isset($_POST["username_email"]) and
    isset($_POST["password"])) {
    $db = new DatabaseHelper();
    $result = false;
    if (($user = $db->findUser($_POST["username_email"])) !== null) {
        $result = $db->checkPassword($user["user_id"], $_POST["password"]);
    } else if (($user = $db->findUserByEmail($_POST["username_email"])) !== null) {
        $result = $db->checkPassword($user["user_id"], $_POST["password"]);
    }
    if ($result === true) {
        require "home.php";
    } else {
        require "login.php";
    }
}
