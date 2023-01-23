<?php
require_once "../bootstrap.php";

if (isset($_POST["action"])
    && isset($_POST["user"])
    && isset($_SESSION["user"]["user_id"])) {
    $db = new DatabaseHelper();
    if ($_POST["action"] === "follow") {
        $result = $db->createFollowing($_SESSION["user"]["user_id"], $_POST["user"]);
    } else if ($_POST["action"] === "unfollow") {
        $result = $db->deleteFollowing($_SESSION["user"]["user_id"], $_POST["user"]);
    } else {
        //action param not set correctly
        echo json_encode(array("success" => -1));
        exit();
    }
    if ($result) {
        //(un)followed successfully
        echo json_encode(array("success" => 1));
    } else {
        //could not (un)follow
        echo json_encode(array("success" => 0));
    }
} else {
    //params unset
    echo json_encode(array("success" => -1));
}
