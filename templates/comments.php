<!-- In main -->
<?php $db = new DatabaseHelper(); ?>
<?php $post = $db->findPost($templateParams("post")); ?>
<?php $comments = $db->findAllComments($post["post_id"]); ?>

<!-- Input new comment -->
<div class="new-comment">
    <img src="<?=PROFILE_PICS_DIR.$_SESSION["user"]["user_picture_path"]?>" alt="<?=$_SESSION["user"]["user_id"]?>'s profile pic">
    <input type="text" id="comment_content" name="comment_content" placeholder="Comment as <?=$_SESSION["user"]["user_id"]?>">
    <label for="comment_content"></label>
    <button type="submit" id="submit-button" name="new_comment" value="new_comment" disabled>Send</button>
</div>

<!-- Display comments from DB -->
<?php foreach ($comments as $comment): ?>
<?php $user = $db->findUser($comment["user_id"]); ?>
<section>
    <a href="user_profile.php?user=<?=$user["user_id"]?>" class="no-underline">
        <img src="<?=PROFILE_PICS_DIR.$user["user_picture_path"]?>" alt="<?=$user["user_id"]?>'s user image">
    </a>
    <a href="user_profile.php?user=<?=$user["user_id"]?>" class="no-underline">
        <strong><?=$user["user_name"]?></strong>
        <p><?=$comment["content"]?></p>
    </a>
    <p>
        <?php
        try {
            $time = new DateTime($comment["comment_time"]);
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
    </p>
</section>
<?php endforeach; ?>
