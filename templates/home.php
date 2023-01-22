<!-- In main -->
<?php foreach ($templateParams["posts"] as $post): ?>
<?php $db = new DatabaseHelper(); ?>
<?php $user = $db->findUser($post["user_id"]); ?>
<!-- Post -->
<article>
    <!-- Post header: user profile picture + user name + post date -->
    <header>
                <!-- to add UPLOAD_DIR. -->
        <img src="<?=$user["user_picture_path"]?>" alt="<?=$user["user_id"]?>'s user image"/>
        <div><h1><?=$user["user_name"]?></h1><p><?=$post["post_time"]?></p></div>
    </header>
    <!-- Post main: post content + media -->
    <main>
        <p><?=$post["content"]?></p>
        <?php foreach (array($post["media_path0"], $post["media_path1"], $post["media_path2"],
                            $post["media_path3"], $post["media_path4"], $post["media_path5"],
                            $post["media_path6"], $post["media_path7"], $post["media_path8"],
                            $post["media_path9"]) as $media): ?>
            <?php if ($media !== null): ?>
                <img src="<?=$media?>" alt="Post media"/>   <!-- to add UPLOAD_DIR. -->
            <?php endif; ?>
        <?php endforeach; ?>
    </main>
    <!-- Post section 1: num likes + num comments -->
    <section>
        <p><?=$post["num_likes"]?> likes</p>
        <p><?=$post["num_comments"]?> comments</p>
    </section>
    <!-- Post section 2: like button + comment button -->
    <section>
        <img src="img/likes2.png" alt="Like button"/>    <!-- to make it work using js -->
        <img src="img/comments.png" alt="Comment button"/>    <!-- to make it work using js -->
    </section>
</article>
<?php endforeach; ?>
