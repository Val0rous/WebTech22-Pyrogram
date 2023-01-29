<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once "../bootstrap.php";

$db = new DatabaseHelper();

if (strlen($_POST["location"]) === 0) {
    $_POST["location"] = null;
}

$number = count($_FILES["media"]["name"]);
if ((strlen($_POST["post_content"]) > 0) or ($number > 0)) {
    $array = array();
    $paths = array();
    if (isset($_FILES["media"]) and ($number > 0)) {
        //$files = array_filter($_FILES["media"]["name"]);

        //gathering media
        for ($i = 0; $i < $number; $i++) {
            $tmp_file_path = $_FILES["media"]["tmp_name"][$i];

            if ($tmp_file_path !== "") {
                $new_file_path = $_FILES["media"]["name"][$i];
                array_push($array, $new_file_path);
                array_push($paths, $tmp_file_path);
            }
        }
    } else {
        $array = null;
    }
    $flag = $db->createPost($_POST["post_content"], $_SESSION["user"]["user_id"], $array, $_POST["location"]);

    if ($flag and ($array !== null)) {
        for ($i = 0; $i < $number; $i++) {
            move_uploaded_file($paths[$i], "../".MEDIA_DIR.$array[$i]);
        }
    }
}
header("Location: ../home.php");
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
