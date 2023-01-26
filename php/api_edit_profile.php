<?php

require_once "../bootstrap.php";

$db = new DatabaseHelper();
if (($db->checkUserIDAvailability($_POST["username"])) or ($_SESSION["user"]["user_id"] == $_POST["username"])) {
    $db->changeUserId($_SESSION["user"]["user_id"], $_POST["username"]);
    $_SESSION["user"]["user_id"] = $_POST["username"];
    if (isset($_POST["profile_pic"])) {
        $db->changeUserPicture($_SESSION["user"]["user_id"], $_POST["profile_pic"]);
        $_SESSION["user"]["user_picture_path"] = $_POST["profile_pic"];
    }
    $db->changeUserName($_SESSION["user"]["user_id"], $_POST["name"]);
    $_SESSION["user"]["user_name"] = $_POST["name"];
    $db->changeUserBio($_SESSION["user"]["user_id"], $_POST["bio"]);
    $_SESSION["user"]["user_bio"] = $_POST["bio"];
    echo json_encode(array("success" => 1));
} else {
    echo json_encode(array("success" => 0));
}