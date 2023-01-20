<!-- In main -->
<!-- to add stories -->
<?php foreach ($templateParams["posts"] as $post): ?>
<article>
    <!-- Post header: user image + user name + post date -->
    <header>
                <!-- to add UPLOAD_DIR. -->
        <img src="<?=$post["user_image"]?>" alt="<?=$post["user_name"]?>'s user image"/>
        <div><h1><?=$post["user_name"]?></h1><p><?=$post["date"]?></p></div>
    </header>
    <!-- Post main: post content + media -->
    <main>
        <p><?=$post["content"]?></p>
        <?php foreach ($post["media"] as $media): ?>
        <img src="<?=$media?>" alt="Post media"/>   <!-- to add UPLOAD_DIR. -->
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
