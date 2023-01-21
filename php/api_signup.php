<?php
require_once "../db/DatabaseHelper.php";

if (isset($_POST["email"]) and
    isset($_POST["full_name"]) and
    isset($_POST["username"]) and
    isset($_POST["password"])) {
    $db = new DatabaseHelper();
    if ($db->createUser($_POST["username"], $_POST["full_name"], $_POST["email"], $_POST["password"], "img/default_profile_pic.jpg")) {  //"db/media/profile_pics/default.png"
        echo json_encode(array("success" => 1));
    } else {
        echo json_encode(array("success" => 0));
    }
    //var_dump($db);
    /*
    echo "Created user ", $_POST["full_name"],
        "with username ", $_POST["username"],
        "and email ", $_POST["email"],
        ", and his password is ", $_POST["password"];
    */
} else {
    echo json_encode(array("success" => -1));
}
