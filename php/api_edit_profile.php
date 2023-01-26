<?php

require_once "../bootstrap.php";

$db = new DatabaseHelper();
if ($db->checkUserIDAvailability($_POST["username"]) || $_SESSION["user"]["user_id"] == $_POST["username"]) {
    //$db->changeUserId($_SESSION["user"]["user_id"], $_POST["username"]);
    //$_SESSION["user"]["user_id"] = $_POST["username"];
    if (isset($_FILES["profile_pic"]) && strlen($_FILES["profile_pic"]["name"]) > 0) {
        $db->changeUserPicture($_SESSION["user"]["user_id"], PROFILE_PICS_DIR.$_FILES["profile_pic"]["name"]);
        move_uploaded_file($_FILES["profile_pic"]["tmp_name"], "../".PROFILE_PICS_DIR.$_FILES["profile_pic"]["name"]);
        $_SESSION["user"]["user_picture_path"] = PROFILE_PICS_DIR.$_FILES["profile_pic"]["name"];
    }
    $db->changeUserName($_SESSION["user"]["user_id"], $_POST["name"]);
    $_SESSION["user"]["user_name"] = $_POST["name"];
    $db->changeUserBio($_SESSION["user"]["user_id"], $_POST["bio"]);
    $_SESSION["user"]["user_bio"] = $_POST["bio"];
    header("Location: ../profile.php");
    //echo json_encode(array("success" => 1));
} else {
    header("Location: ../edit_profile.php");
    //echo json_encode(array("success" => 0));
}