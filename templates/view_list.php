<!-- In main -->
<?php $list = $templateParams["list"]; ?>
<?php $header = $templateParams["header"]; ?>
<?php $db = new DatabaseHelper(); ?>

<!-- Top bar -->
<div class="top-bar">
    <button onclick="history.back()">
        <svg class="go-back" viewBox="0 0 24 24">
            <path d="M21 17.502a.997.997 0 0 1-.707-.293L12 8.913l-8.293 8.296a1 1 0 1 1-1.414-1.414l9-9.004a1.03 1.03 0 0 1 1.414 0l9 9.004A1 1 0 0 1 21 17.502Z"></path>
        </svg>
    </button>
    <h1><?=$header?></h1>
</div>

<?php if (!empty($list)): ?>
<section>
<?php foreach ($list as $item):
    if ($_SESSION["user"]["user_id"] !== $item["user_id"]): ?>
        <!-- User result -->
        <a href="user_profile.php?user=<?=$item["user_id"]?>" class="no-underline">
            <!-- User profile picture -->
            <img src="<?=PROFILE_PICS_DIR.$item["user_picture_path"]?>" alt="<?=$item["user_id"]?>'s user image">
            <!-- User username and name -->
            <section>
                <p><?=$item["user_id"]?></p>
                <p><?=$item["user_name"]?></p>
            </section>
            <!-- Follow/following button -->
            <?php if ($db->findFollowing($_SESSION["user"]["user_id"], $item["user_id"])): ?>
                <button type="button" class="search following">Following</button>
            <?php else: ?>
                <button type="button" class="search follow">Follow</button>
            <?php endif; ?>
        </a>
    <?php else: ?>
        <!-- Found yourself -->
        <a href="profile.php" class="no-underline">
            <!-- User profile picture -->
            <img src="<?=PROFILE_PICS_DIR.$item["user_picture_path"]?>" alt="<?=$item["user_id"]?>'s user image">
            <!-- User username and name -->
            <section>
                <p><?=$item["user_id"]?></p>
                <p><?=$item["user_name"]?></p>
            </section>
            <p>You</p>
        </a>
    <?php endif;
endforeach; ?>
</section>
<?php else : ?>
<p>Nothing here but crickets</p>
<?php endif; ?>
