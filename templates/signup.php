<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign&nbsp;up&nbsp;&bull;&nbsp;Pyrogram</title>
    <link rel="stylesheet" type="text/css" href="css/login_signup.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <!--<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>-->
    <script src="js/signup.js" type="text/javascript"></script>
</head>
<main>
    <form method="post">
        <h1>Pyrogram</h1>
        <div class="input-box">
            <label for="email">Email:</label><br>
            <input type="text" id="email" name="email" value=""><br>
        </div>
        <div class="input-box">
            <label for="full_name">Full Name:</label><br>
            <input type="text" id="full_name" name="full_name" value=""><br>
        </div>
        <div class="input-box">
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username" value=""><br>
        </div>
        <div class="input-box">
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" value="">
            <button type="button" class="show-password">Show</button><br>
        </div>
        <button type="submit" id="submit-button" name="signup" value="signup">Sign Up</button>
    </form>
    <div>
        Already have an account?
        <a href="login.php">Log In</a>
    </div>
</main>
</html>
