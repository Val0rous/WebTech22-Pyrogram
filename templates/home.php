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
        <div>
            <strong><?=$user["user_name"]?></strong>
            <p><?=$post["post_time"]?>
            <?php if ($post["location"] !== null): ?>
            &nbsp;&bull;&nbsp;&nbsp;<?=$post["location"]?>
            <?php endif; ?>
            </p>
        </div>
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
        <!--<img src="img/likes2.png" alt="Like button"/>-->    <!-- to make it work using js -->
        <svg aria-label="Like" class="buttons" viewbox="0 0 24 24" role="img">
            <path d="M16.792 3.904A4.989 4.989 0 0 1 21.5 9.122c0 3.072-2.652 4.959-5.197 7.222-2.512 2.243-3.865 3.469-4.303 3.752-.477-.309-2.143-1.823-4.303-3.752C5.141 14.072 2.5 12.167 2.5 9.122a4.989 4.989 0 0 1 4.708-5.218 4.21 4.21 0 0 1 3.675 1.941c.84 1.175.98 1.763 1.12 1.763s.278-.588 1.11-1.766a4.17 4.17 0 0 1 3.679-1.938m0-2a6.04 6.04 0 0 0-4.797 2.127 6.052 6.052 0 0 0-4.787-2.127A6.985 6.985 0 0 0 .5 9.122c0 3.61 2.55 5.827 5.015 7.97.283.246.569.494.853.747l1.027.918a44.998 44.998 0 0 0 3.518 3.018 2 2 0 0 0 2.174 0 45.263 45.263 0 0 0 3.626-3.115l.922-.824c.293-.26.59-.519.885-.774 2.334-2.025 4.98-4.32 4.98-7.94a6.985 6.985 0 0 0-6.708-7.218Z"></path>
        </svg>
        <!--<img src="img/comments.png" alt="Comment button"/>-->    <!-- to make it work using js -->
        <svg aria-label="Comment" class="buttons" viewBox="0 0 24 24" role="img">
            <path d="M20.656 17.008a9.993 9.993 0 1 0-3.59 3.615L22 22Z" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="2"></path>
        </svg>
    </section>
</article>
<?php endforeach; ?>
