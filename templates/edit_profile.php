<!-- In main -->

<div>
    <!-- Top bar -->
    <div class="top-bar">
        <!-- "X" button to go back -->
        <a class="no-underline" href="profile.php">
            <svg class="close" role="img" viewBox="0 0 24 24">
                <title>Close</title>
                <polyline fill="none" points="20.643 3.357 12 12 3.353 20.647" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"></polyline>
                <line fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3" x1="20.649" x2="3.354" y1="20.649" y2="3.354"></line>
            </svg>
        </a>
        <!-- "Edit profile" title -->
        <h1>Edit profile</h1>
        <!-- Submit button -->
        <button type="submit">Submit</button>
    </div>

    <!-- User info to edit -->
    <form action="php/api_edit_profile.php" method="post" enctype="multipart/form-data">
        <!-- Profile picture -->
        <div class="profile-pic">
            <img src="<?=PROFILE_PICS_DIR.$_SESSION["user"]["user_picture_path"]?>" alt="<?=$_SESSION["user"]["user_id"]?>'s profile picture" />
            <div>
                <label for="profile-pic">Choose a new profile picture:</label>
                <input type="file" id="profile-pic" name="profile_pic" />
            </div>
        </div>
        <!-- Username -->
        <div class="username">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="<?=$_SESSION["user"]["user_id"]?>" readonly />
        </div>
        <!-- Name -->
        <div class="name">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?=$_SESSION["user"]["user_name"]?>"/>
        </div>
        <!-- Bio -->
        <div class="bio">
            <label for="bio">Bio:</label>
            <textarea id="bio" name="bio" rows="5"><?=$_SESSION["user"]["user_bio"]?></textarea>
        </div>
    </form>
</div>