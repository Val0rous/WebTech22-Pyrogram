<?php
require_once "../bootstrap.php";

if(isset($_POST["post"])) {
    $db = new DatabaseHelper();
    $result = $db->createPost($_POST["post_content"]);
    if ($result) {
        //post created successfully
        echo json_encode(array("success" => 1));
    } else {
        //could not create post
        echo json_encode(array("success" => 0));
    }
} else {
    //params unset
    echo json_encode(array("success" => 0));
}