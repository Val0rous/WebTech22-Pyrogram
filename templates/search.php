<!-- In main -->

<!-- Form with search label and field -->
<form action="#" method="post">
    <label for="Search">Search</label>
    <input type="search" id="Search" name="search" placeholder="Search" value="<?php if (isset($_POST["search"])) echo $_POST["search"]; ?>"/>
    <input type="submit">
</form>

<!-- Search results -->
<?php
if (isset($_POST["search"]) && $_POST["search"] != ""):
    $db = new DatabaseHelper();
    $users = $db->searchUser($_POST["search"]); ?>
    <?php if (!empty($users)): ?>
        <!-- User results box -->
        <section>
            <?php foreach ($users as $user): ?>
                <!-- User result -->
                <a href="user_profile.php" class="no-underline">
                    <!-- User profile picture -->
                    <img src="<?=$user["user_picture_path"]?>" alt="<?=$user["user_id"]?>'s user image">
                    <!-- User username and name -->
                    <section>
                        <p><?=$user["user_id"]?></p>
                        <p><?=$user["user_name"]?></p>
                    </section>
                    <!-- Follow/following button -->
                    <?php if ($db->findFollowing($_SESSION["user"]["user_id"], $user["user_id"])): ?>
                        <button type="button" class="search following">Following</button>
                    <?php elseif ($_SESSION["user"]["user_id"] != $user["user_id"]): ?>
                        <button type="button" class="search follow">Follow</button>
                    <?php endif; ?>
                </a>
            <?php endforeach; ?>
        </section>
    <?php else: ?>
        <p>No results found</p>
    <?php endif; ?>
<?php endif; ?>