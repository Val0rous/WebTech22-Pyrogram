<!-- In main -->
<?php
$post = $templateParams["post"];
$db = new DatabaseHelper();
$user = $db->findUser($post["user_id"]);
require "templates/post.php";
?>
