<!-- In main -->
<?php
foreach ($templateParams["posts"] as $post) {
    $db = new DatabaseHelper();
    $user = $db->findUser($post["user_id"]);
    // Post
    require "templates/post.php";
}
?>
