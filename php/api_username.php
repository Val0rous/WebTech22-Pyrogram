<?php
require_once "../db/DatabaseHelper.php";

if (isset($_POST["username"])) {
    $db = new DatabaseHelper();
    if ($db->checkUserIDAvailability($_POST["username"])) {
        echo json_encode(array("available" => 1));
    } else {
        echo json_encode(array("available" => 0));
    }
} else {
    echo json_encode(array("available" => -1));
}
