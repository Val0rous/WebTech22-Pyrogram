    <!-- In main -->

        <div>
            <!-- Top bar -->
            <div class="top-bar">
                <!-- Username -->
                <h1><?=$_SESSION["user"]["user_id"]?></h1>
                <!-- Logout button -->
                <button type="button">Logout</button>
            </div>

            <!-- User info -->
            <header>
                <div class="stats">
                    <!-- Profile picture -->
                    <img class="profile-pic" src="<?=PROFILE_PICS_DIR.$_SESSION["user"]["user_picture_path"]?>" alt="<?=$_SESSION["user"]["user_id"]?>'s profile picture">
                    <div>
                        <!-- Number of posts -->
                        <div class="num-posts">
                            <?=$_SESSION["user"]["num_posts"]?> Posts
                        </div>
                        <!-- Number of followers -->
                        <a class="num-followers no-underline" href="view_list.php?type=followers&user=<?=$_SESSION["user"]["user_id"]?>">
                            <?=$_SESSION["user"]["num_followers"]?> Followers
                        </a>
                        <!-- Number of followings -->
                        <a class="num-followings no-underline" href="view_list.php?type=following&user=<?=$_SESSION["user"]["user_id"]?>">
                            <?=$_SESSION["user"]["num_following"]?> Followings
                        </a>
                    </div>
                </div>

                <div class=info>
                    <div>
                        <!-- Name -->
                        <div class="user-name"><?=$_SESSION["user"]["user_name"]?></div>
                        <!-- Bio -->
                        <div class="user-bio"><?=$_SESSION["user"]["user_bio"]?></div>
                    </div>
                    <!-- "Edit profile" button -->
                    <a href="edit_profile.php">
                        <button type="button" class="edit-profile">Edit profile</button>
                    </a>
                </div>
            </header>
        </div>

<?php // Posts
require "templates/home.php"; ?>
