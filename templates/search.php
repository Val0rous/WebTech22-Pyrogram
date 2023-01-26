<!-- In main -->

<!-- Form with search label and field -->
<form action="#">
    <label for="Search">Search</label>
    <input type="search" id="Search" name="search" placeholder="Search" value="<?php if (isset($_GET["search"])) echo $_GET["search"]; ?>"/>
    <input type="submit">
</form>

<!-- Search results -->
<?php
if (isset($_GET["search"]) && $_GET["search"] != ""):
    $db = new DatabaseHelper();
    $users = $db->searchUser($_GET["search"]); ?>
    <?php if (!empty($users)): ?>
        <!-- User results box -->
        <section>
            <?php foreach ($users as $user):
                if ($_SESSION["user"]["user_id"] != $user["user_id"]): ?>
                    <!-- User result -->
                    <a href="user_profile.php?user=<?=$user["user_id"]?>" class="no-underline">
                        <!-- User profile picture -->
                        <img src="<?=PROFILE_PICS_DIR.$user["user_picture_path"]?>" alt="<?=$user["user_id"]?>'s user image">
                        <!-- User username and name -->
                        <section>
                            <p><?=$user["user_id"]?></p>
                            <p><?=$user["user_name"]?></p>
                        </section>
                        <!-- Follow/following button -->
                        <?php if ($db->findFollowing($_SESSION["user"]["user_id"], $user["user_id"])): ?>
                            <button type="button" class="search following">Following</button>
                        <?php else: ?>
                            <button type="button" class="search follow">Follow</button>
                        <?php endif; ?>
                    </a>
                <?php else: ?>
                    <!-- Found yourself -->
                    <a href="profile.php" class="no-underline">
                        <!-- User profile picture -->
                        <img src="<?=PROFILE_PICS_DIR.$user["user_picture_path"]?>" alt="<?=$user["user_id"]?>'s user image">
                        <!-- User username and name -->
                        <section>
                            <p><?=$user["user_id"]?></p>
                            <p><?=$user["user_name"]?></p>
                        </section>
                        <p>You</p>
                    </a>
                <?php endif;
            endforeach; ?>
        </section>
    <?php else: ?>
        <p>No results found</p>
    <?php endif; ?>
<?php endif; ?>