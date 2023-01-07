<!-- In main -->
<h2>Home<h2>
<!-- TO COMPLETE -->
<?php foreach($templateParams["posts"] as $post): ?>
<article>
    <!-- Post header: user image + user name + post date -->
    <header>
        <img src="<?=UPLOAD_DIR.$post["profileImage"]?>" alt="<?=$post["profileName"]?> profile image"/>
        <p><?=$post["profileName"]?></p>
        <p><?=$post["date"]?></p>
    </header>
    <!-- Post main: post content + media -->
    <main>
        <p><?=$post["content"]?></p>
        <!-- media -->
    </main>
    <!-- Post section 1: num likes + like button -->
    <section>
        <p><?=$post["numLikes"]?></p>
        <img src="<?=UPLOAD_DIR?>likeButton" alt="Like button"/>    <!-- to make it work using js -->
    </section>
    <!-- Post section 2: num comments + comment button -->
    <section>
        <p><?=$post["numComments"]?></p>
        <img src="<?=UPLOAD_DIR?>commentButton" alt="Comment button"/>    <!-- to make it work using js -->
    </section>
</article>
<?php endforeach; ?>