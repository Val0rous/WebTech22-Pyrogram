<?php
/*
require_once "../db/DatabaseHelper.php";
if (!session_id()) {
    session_start();
}
*/
require_once "../bootstrap.php";

if (isset($_POST["username_email"]) and isset($_POST["password"])) {
    $db = new DatabaseHelper();
    if (($user = $db->findLogin($_POST["username_email"], $_POST["password"])) !== null) {
        //user logged in
        $_SESSION["user"] = $user;  //use inside website
        //time() + (30 * 24 * 60 * 60)
        //both cookies valid throughout the entire domain
        setcookie("user", $user["user_id"], strtotime("+30days"), "/");
        setcookie("token", generateRandomString(), strtotime("+30days"), "/");
        echo json_encode(array("success" => 1));
    } else {
        //could not log in
        echo json_encode(array("success" => 0));
    }
} else {
    //params unset
    echo json_encode(array("success" => 0));
}

function generateRandomString($length = 16): string
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
