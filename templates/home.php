<!-- In main -->
<!-- <h1>Home</h1> -->
<!-- to add stories -->
<?php foreach ($templateParams["posts"] as $post): ?>
<article>
    <!-- Post header: user image + user name + post date -->
    <header>
                <!-- to add UPLOAD_DIR. -->
        <img src="<?=$post["profileImage"]?>" alt="<?=$post["profileName"]?>'s profile image"/>
        <div><h2><?=$post["profileName"]?></h2><p><?=$post["date"]?></p></div>
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
        <p><?=$post["numLikes"]?> likes</p>
        <p><?=$post["numComments"]?> comments</p>
    </section>
    <!-- Post section 2: like button + comment button -->
    <section>
        <img src="img/likes2.png" alt="Like button"/>    <!-- to make it work using js -->
        <img src="img/comments.png" alt="Comment button"/>    <!-- to make it work using js -->
    </section>
</article>
<?php endforeach; ?>

<!-- scroll down test -->
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<!-- scroll down test -->
