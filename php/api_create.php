<?php

require_once "../bootstrap.php";

$db = new DatabaseHelper();

if (strlen($_POST["location"]) === 0) {
    $_POST["location"] = null;
}

if (strlen($_POST["post_content"]) > 0 || isset($_FILES["media"])) {
    if (isset($_FILES["media"]) && strlen($_FILES["media"]["name"]) > 0) {
        $db->createPost($_POST["post_content"], $_SESSION["user"]["user_id"], array($_FILES["media"]["name"]), $_POST["location"]);
        move_uploaded_file($_FILES["media"]["tmp_name"], "../".MEDIA_DIR.$_FILES["media"]["name"]);
    } else {
        $db->createPost($_POST["post_content"], $_SESSION["user"]["user_id"], null, $_POST["location"]);
    }
}
header("Location: ../create.php");
exit();


/*if (isset($_POST["post_content"]) && isset($_SESSION["user"]["user_id"])) {
    $db = new DatabaseHelper();
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
}*/
