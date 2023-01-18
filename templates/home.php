<!-- In main -->
<!-- <h2>Home<h2> -->
<!-- to add stories -->
<?php foreach ($templateParams["posts"] as $post): ?>
<article>
    <!-- Post header: user image + user name + post date -->
    <header>
                <!-- to add UPLOAD_DIR. -->
        <img src="<?=$post["profileImage"]?>" alt="<?=$post["profileName"]?> profile image"/>
        <div>
            <h2><?=$post["profileName"]?></h2>
            <p><?=$post["date"]?></p>
        </div>
    </header>
    <!-- Post main: post content + media -->
    <main>
        <p><?=$post["content"]?></p>
        <?php foreach ($post["media"] as $media): ?>
        <img src="<?=$media?>" alt="Post media"/>
        <?php endforeach; ?>
    </main>
    <!-- Post section 1: num likes + like button -->
    <section>
        <p><?=$post["numLikes"]?></p>
        <img src="img/likes.png" alt="Like button"/>    <!-- to make it work using js -->
    </section>
    <!-- Post section 2: num comments + comment button -->
    <section>
        <p><?=$post["numComments"]?></p>
        <img src="img/comments.png" alt="Comment button"/>    <!-- to make it work using js -->
    </section>
</article>
<?php endforeach; ?>