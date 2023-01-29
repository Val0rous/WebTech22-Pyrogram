<!-- In main -->
<?php
$db = new DatabaseHelper();
$comments = $db->findAllComments($templateParams["post"]["post_id"]);
?>

<!-- Top bar -->
<div class="top-bar">
    <button onclick="history.back()">
        <svg class="go-back" viewBox="0 0 24 24">
            <path d="M21 17.502a.997.997 0 0 1-.707-.293L12 8.913l-8.293 8.296a1 1 0 1 1-1.414-1.414l9-9.004a1.03 1.03 0 0 1 1.414 0l9 9.004A1 1 0 0 1 21 17.502Z"></path>
        </svg>
    </button>
    <h1>Comments</h1>
</div>

<!-- Form new comment -->
<form action="php/api_comments.php" method="post">
    <!-- User profile picture -->
    <img src="<?=PROFILE_PICS_DIR.$_SESSION["user"]["user_picture_path"]?>" alt="<?=$_SESSION["user"]["user_id"]?>'s profile pic">
    <!-- Input comment content -->
    <label for="comment_content">Comment</label>
    <textarea id="comment_content" name="comment_content" rows="1" placeholder="Comment as <?=$_SESSION["user"]["user_id"]?>"></textarea>
    <!-- Hidden inputs for operational reasons -->
    <input type="hidden" name="user_id" value="<?=$_SESSION["user"]["user_id"]?>"></input>
    <input type="hidden" name="post_id" value="<?=$templateParams["post"]["post_id"]?>"></input>
    <!-- Send button -->
    <button type="submit">Send</button>
</form>

<!-- Display comments from DB -->
<?php foreach ($comments as $comment): ?>
<?php $user = $db->findUser($comment["user_id"]); ?>
<section>
    <div>
        <!-- User profile picture -->
        <a href="user_profile.php?user=<?=$user["user_id"]?>" class="no-underline">
            <img src="<?=PROFILE_PICS_DIR.$user["user_picture_path"]?>" alt="<?=$user["user_id"]?>'s user image">
        </a>
        <div>
            <!-- User profile name -->
            <a href="user_profile.php?user=<?=$user["user_id"]?>" class="no-underline">
                <p><?=$user["user_name"]?></p>
            </a>
            <!-- Comment date -->
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
        </div>
    </div>
    <!-- Comment content -->
    <p><?=$comment["content"]?></p>
</section>
<?php endforeach; ?>
