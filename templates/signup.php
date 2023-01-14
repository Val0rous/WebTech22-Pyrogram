<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign&nbsp;up&nbsp;&bull;&nbsp;Pyrogram</title>
    <link rel="stylesheet" type="text/css" href="css/login_signup.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <!--<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>-->
    <script src="js/login_signup.js" type="text/javascript"></script>
    <script src="js/signup.js" type="text/javascript"></script>
</head>
<main>
    <form id="signup-form" method="post">
        <h1>Pyrogram</h1>
        <div class="input-box">
            <input type="text" id="email" name="email" placeholder=" ">
            <label for="email">Email:</label>
        </div>
        <div class="input-box">
            <input type="text" id="full_name" name="full_name" placeholder=" ">
            <label for="full_name">Full Name:</label>
        </div>
        <div class="input-box">
            <input type="text" id="username" name="username" placeholder=" ">
            <label for="username">Username:</label>
        </div>
        <div class="input-box">
            <input type="password" id="password" name="password" placeholder=" ">
            <label for="password">Password:</label>
            <button type="button" class="show-password">Show</button>
        </div>
        <button type="submit" id="submit-button" name="signup" value="signup">Sign Up</button>
    </form>
    <div>
        Already have an account?
        <a href="login.php">Log In</a>
    </div>
</main>
</html>
