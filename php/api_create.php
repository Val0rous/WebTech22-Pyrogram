<?php
//require_once "../db/DatabaseHelper.php";
require_once "../bootstrap.php";

var_dump($_POST["media"][0]);

if (isset($_SESSION["user"]["user_id"])) {
    $db = new DatabaseHelper();

    if (isset($_POST["post_content"])
        && isset()) {

    }
    $result = $db->createPost($_POST["post_content"], $_SESSION["user"]["user_id"]);

    if ($result) {
        //post created successfully
        echo json_encode(array("success" => 1));
    } else {
        //could not create post
        echo json_encode(array("success" => 0));
    }
} else {
    //params unset
    echo json_encode(array("success" => -1));
}
