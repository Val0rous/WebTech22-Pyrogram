<?php
require_once "../bootstrap.php";

$db = new DatabaseHelper();
$notifications = $db->fetchAllNotifications($_SESSION["user"]["user_id"]);
$new_notifications = 0;

foreach ($notifications as $notification) {
    if ($notification["read_status"] === "0") {
        $new_notifications++;
    }
}

echo json_encode(array("newNotifications" => $new_notifications));
