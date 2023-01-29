<!-- In main -->
<div class="overlay">
    <header>
        <a class="no-underline" href="home.php">
            <svg class="close" role="img" viewBox="0 0 24 24">
                <title>Close</title>
                <polyline fill="none" points="20.643 3.357 12 12 3.353 20.647" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"></polyline>
                <line fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3" x1="20.649" x2="3.354" y1="20.649" y2="3.354"></line>
            </svg>
        </a>
        <h1>Create post</h1>
    </header>
</div>

<form action="php/api_create.php" id="create-form" method="post" enctype="multipart/form-data">
    <article>
        <header>
            <img src="<?=PROFILE_PICS_DIR.$_SESSION["user"]["user_picture_path"]?>" alt="<?=$_SESSION["user"]["user_id"]?>'s profile pic">
            <span><?=$_SESSION["user"]["user_name"]?></span>
        </header>
        <main>
            <!-- Post content -->
            <textarea id="post_content" name="post_content" placeholder="What's on your mind?"></textarea>
            <label for="post_content"></label>
            <!-- Post location -->
            <label for=location>Location</label>
            <input type=text id="location" name="location" placeholder="Location" value="" />
            <!-- Post media -->
            <label for="media">Upload an image:</label>
            <input type="file" id="media" name="media" multiple accept=".jpeg, .jpg, .png, .webp, .gif, .mp4, .svg"/>
        </main>
        <section></section>
        <button type="submit" id="submit-button" name="create_post" value="create_post">Post</button>
    </article>
</form>
