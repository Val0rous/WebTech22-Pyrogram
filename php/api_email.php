<?php
require_once "../db/DatabaseHelper.php";

if (isset($_POST["email"])) {
    $db = new DatabaseHelper();
    if ($db->checkUserEmailAvailability($_POST["email"])) {
        echo json_encode(array("available" => 1));
    } else {
        echo json_encode(array("available" => 0));
    }
} else {
    echo json_encode(array("available" => -1));
}
