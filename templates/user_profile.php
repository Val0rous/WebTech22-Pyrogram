<!-- In main -->
<?php
$db = new DatabaseHelper();
if (!isset($_GET["user"])) {
    exit("An error occured");
}
$user = $db->findUser($_GET["user"]);
?>
        <div>
            <!-- Top bar -->
            <div class="top-bar">
                <h1><?=$user["user_id"]?></h1>
            </div>

            <!-- User info -->
            <header>
                <div class="stats">
                    <img class="profile-pic" src="<?=PROFILE_PICS_DIR.$user["user_picture_path"]?>" alt="<?=$user["user_id"]?>'s profile picture">
                    <div>
                        <div class="num-posts">
                            <?=$user["num_posts"]?> Posts
                        </div>
                        <a class="num-followers no-underline" href="view_list.php?type=followers&user=<?=$_SESSION["user"]["user_id"]?>">
                            <?=$user["num_followers"]?> Followers
                        </a>
                        <a class="num-following no-underline" href="view_list.php?type=following&user=<?=$_SESSION["user"]["user_id"]?>">
                            <?=$user["num_following"]?> Following
                        </a>
                    </div>
                </div>

                <div class=info>
                    <div>
                        <div class="user-name"><?=$user["user_name"]?></div>
                        <div class="user-bio"><?=$user["user_bio"]?></div>
                    </div>
                    <?php if ($db->findFollowing($_SESSION["user"]["user_id"], $user["user_id"])): ?>
                        <button type="button" class="user_profile following">Following</button>
                    <?php else: ?>
                        <button type="button" class="user_profile follow">Follow</button>
                    <?php endif; ?>
                </div>
            </header>
        </div>

<?php // Posts
require "templates/home.php"; ?>