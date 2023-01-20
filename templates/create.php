<!-- In main -->
<div class="overlay">
    <header>
        <svg class="close" role="img" viewBox="0 0 24 24">
            <title>Close</title>
            <polyline fill="none" points="20.643 3.357 12 12 3.353 20.647" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"></polyline>
            <line fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3" x1="20.649" x2="3.354" y1="20.649" y2="3.354"></line>
        </svg>
        <h1>Create post</h1>
    </header>
</div>

<form>
    <header>
        <img src="<?=$_SESSION["user"]["user_picture_path"]?>" alt="<?=$_SESSION["user"]["user_id"]?>'s profile pic">
        <span>User name</span>
    </header>
    <input type="text" id="post_content" name="post_content" placeholder="What's on your mind?">
    <label for="post_content"></label>
    <section></section>
    <button type="submit" id="submit-button" name="create_post" value="create_post" disabled>Post</button>
</form>
