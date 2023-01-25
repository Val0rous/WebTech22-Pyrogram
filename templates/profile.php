<!-- In main -->

<div>
    <!-- Top bar -->
    <div class="top-bar">
        <h1><?=$_SESSION["user"]["user_id"]?></h1>
    </div>

    <!-- User info -->
    <header>
        <div class="stats">
            <img class="profile-pic" src="<?=$_SESSION["user"]["user_picture_path"]?>" alt="<?=$_SESSION["user"]["user_id"]?>'s user image">
            <div class="num-posts">
                <?=$_SESSION["user"]["num_posts"]?> Posts
            </div>
            <a class="num-followers no-underline" href="view_list.php?type=followers&user=<?=$_SESSION["user"]["user_id"]?>">
                <?=$_SESSION["user"]["num_followers"]?> Followers
            </a>
            <a class="num-following no-underline" href="view_list.php?type=following&user=<?=$_SESSION["user"]["user_id"]?>">
                <?=$_SESSION["user"]["num_following"]?> Following
            </a>
        </div>

        <div class=info>
            <div>
                <div class="user-name"><?=$_SESSION["user"]["user_name"]?></div>
                <div class="user-bio"><?=$_SESSION["user"]["user_bio"]?></div>
            </div>
            <a href="edit-profile">
                <button type="button" class="edit-profile">Edit profile</button>
            </a>
        </div>
    </header>
</div>

<?php foreach ($templateParams["posts"] as $post): ?>
    <?php $db = new DatabaseHelper(); ?>
    <?php $user = $db->findUser($post["user_id"]); ?>
    <!-- Post -->
    <article>
        <!-- Post header: user profile picture + user name + post date -->
        <header>
            <!-- to add UPLOAD_DIR. -->
            <a href="user_profile.php?user=<?=$user["user_id"]?>" class="no-underline">
                <img src="<?=$user["user_picture_path"]?>" alt="<?=$user["user_id"]?>'s user image"/>
                <div>
                    <strong><?=$user["user_name"]?></strong>
                    <p>
                        <?php
                        try {
                            $time = new DateTime($post["post_time"]);
                            $ago = time() - $time->format("U");
                            //convert time in a more human-friendly form
                            if ($ago < 60) {
                                if (floor($ago) == 1) {
                                    //exactly one second
                                    echo floor($ago) . " second ago";
                                } else {
                                    //seconds
                                    echo floor($ago) . " seconds ago";
                                }
                            } else if ($ago < 3600) {
                                if (floor($ago / 60) == 1) {
                                    //exactly one minute
                                    echo floor($ago / 60) . " minute ago";
                                } else {
                                    //minutes
                                    echo floor($ago / 60) . " minutes ago";
                                }
                            } else if ($ago < 86400) {
                                if (floor($ago / 3600) == 1) {
                                    //exactly one hour
                                    echo floor($ago / 3600) . " hour ago";
                                } else {
                                    //hours
                                    echo floor($ago / 3600) . " hours ago";
                                }
                            } else if ($ago < 604800) {
                                if (floor($ago / 86400) == 1) {
                                    //exactly one day
                                    echo floor($ago / 86400) . " day ago";
                                } else {
                                    //days
                                    echo floor($ago / 86400) . " days ago";
                                }
                            } else {
                                if ($time->format("Y") === date("Y")) {
                                    //current year
                                    echo $time->format("F j");
                                } else {
                                    //earlier date
                                    echo $time->format("F j, Y");
                                }
                            }
                        } catch (Exception $e) {
                        }
                        ?>
                        <?php if ($post["location"] !== null): ?>
                            &nbsp;&bull;&nbsp;&nbsp;<?=$post["location"]?>
                        <?php endif; ?>
                    </p>
                </div>
            </a>
            <div class="post-id"><?=$post["post_id"]?></div>
        </header>
        <!-- Post main: post content + media -->
        <main>
            <p><?=$post["content"]?></p>
            <?php
            $medias = array($post["media_path0"], $post["media_path1"], $post["media_path2"],
                $post["media_path3"], $post["media_path4"], $post["media_path5"],
                $post["media_path6"], $post["media_path7"], $post["media_path8"],
                $post["media_path9"]);
            $length = count(array_filter($medias));
            ?>
            <?php if ($length > 0): ?>
                <?php if ($length > 1): ?>
                    <div class="slideshow-container">
                <?php endif; ?>
                <?php foreach ($medias as $media): ?>
                    <?php if ($media !== null): ?>
                        <?php if ($length > 1): ?>
                            <div class="slideshow fade">
                                <div class="index"><?=array_search($media, $medias) + 1?> / <?=$length?></div>
                                <img src="<?=$media?>" alt="Post media"/>   <!-- to add UPLOAD_DIR. -->
                            </div>
                        <?php else: ?>
                            <img src="<?=$media?>" alt="Post media"/>   <!-- to add UPLOAD_DIR. -->
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
                <?php if ($length > 1): ?>
                    <!-- Next and Previous buttons -->
                    <a class="prev">&#10094;</a>
                    <a class="next">&#10095;</a>
                    </div>
                    <!-- Dots to indicate which image we're on -->
                    <div class="dots">
                        <?php foreach ($medias as $media): ?>
                            <?php if ($media !== null): ?>
                                <span class="dot" value="<?=array_search($media, $medias)?>"></span>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
            <!-- Create image carousel if there's more than one image -->
        </main>
        <!-- Post section 1: num likes + num comments -->
        <section>
            <!-- View likes and View tags -->
            <a href="view_likes.php?post=<?=$post["post_id"]?>" class="no-underline">View likes</a>
            <a href="view_tags.php?post=<?=$post["post_id"]?>" class="no-underline">View tags</a>
        </section>
        <!-- Post section 2: like button + comment button -->
        <section>
            <!--<img src="img/likes2.png" alt="Like button"/>-->    <!-- to make it work using js -->
            <button type="button" class="like
        <?php if ($db->findLike($_SESSION["user"]["user_id"], $post["post_id"])) {
                echo " liked";
            } ?>">
                <svg aria-label="Like" class="buttons like" viewbox="0 0 24 24" role="img">
                    <path d="M16.792 3.904A4.989 4.989 0 0 1 21.5 9.122c0 3.072-2.652 4.959-5.197 7.222-2.512 2.243-3.865 3.469-4.303 3.752-.477-.309-2.143-1.823-4.303-3.752C5.141 14.072 2.5 12.167 2.5 9.122a4.989 4.989 0 0 1 4.708-5.218 4.21 4.21 0 0 1 3.675 1.941c.84 1.175.98 1.763 1.12 1.763s.278-.588 1.11-1.766a4.17 4.17 0 0 1 3.679-1.938m0-2a6.04 6.04 0 0 0-4.797 2.127 6.052 6.052 0 0 0-4.787-2.127A6.985 6.985 0 0 0 .5 9.122c0 3.61 2.55 5.827 5.015 7.97.283.246.569.494.853.747l1.027.918a44.998 44.998 0 0 0 3.518 3.018 2 2 0 0 0 2.174 0 45.263 45.263 0 0 0 3.626-3.115l.922-.824c.293-.26.59-.519.885-.774 2.334-2.025 4.98-4.32 4.98-7.94a6.985 6.985 0 0 0-6.708-7.218Z"></path>
                </svg>
                <svg aria-label="Unlike" class="buttons unlike" viewBox="0 0 48 48" role="img">
                    <path d="M34.6 3.1c-4.5 0-7.9 1.8-10.6 5.6-2.7-3.7-6.1-5.5-10.6-5.5C6 3.1 0 9.6 0 17.6c0 7.3 5.4 12 10.6 16.5.6.5 1.3 1.1 1.9 1.7l2.3 2c4.4 3.9 6.6 5.9 7.6 6.5.5.3 1.1.5 1.6.5s1.1-.2 1.6-.5c1-.6 2.8-2.2 7.8-6.8l2-1.8c.7-.6 1.3-1.2 2-1.7C42.7 29.6 48 25 48 17.6c0-8-6-14.5-13.4-14.5z"></path>
                </svg>
                <div><?=$post["num_likes"]?></div>
            </button>
            <!--<img src="img/comments.png" alt="Comment button"/>-->    <!-- to make it work using js -->
            <a href="comments.php?post=<?=$post["post_id"]?>" class="no-underline">
                <button type="button" class="comment">
                    <svg aria-label="Comment" class="buttons" viewBox="0 0 24 24" role="img">
                        <path d="M20.656 17.008a9.993 9.993 0 1 0-3.59 3.615L22 22Z" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="2"></path>
                    </svg>
                    <div><?=$post["num_comments"]?></div>
                </button>
            </a>
        </section>
    </article>
<?php endforeach; ?>
