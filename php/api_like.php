<?php
require_once "../bootstrap.php";

if (isset($_POST["action"])
    && isset($_POST["post"])
    && isset($_SESSION["user"]["user_id"])) {
    $db = new DatabaseHelper();
    if ($_POST["action"] === "like") {
        $result = $db->createLike($_SESSION["user"]["user_id"], $_POST["post"]);
    } else if ($_POST["action"] === "unlike") {
        $result = $db->deleteLike($_SESSION["user"]["user_id"], $_POST["post"]);
    } else {
        //action params not set correctly
        echo json_encode(array("success" => -1));
        exit();
    }
    if ($result) {
        //(un)liked successfully
        echo json_encode(array("success" => 1, "numLikes" => $db->findPost($_POST["post"])["num_likes"]));
    } else {
        //could not (un)like
        echo json_encode(array("success" => 0));
    }
} else {
    //params unset
    echo json_encode(array("success" => -1));
}