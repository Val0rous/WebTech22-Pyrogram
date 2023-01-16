<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login&nbsp;&bull;&nbsp;Pyrogram</title>
    <link rel="stylesheet" type="text/css" href="css/login_signup.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <!--<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>-->
    <script src="js/login_signup.js" type="text/javascript"></script>
    <script src="js/login.js" type="text/javascript"></script>
</head>
<main>
    <form id="login-form" class="container" method="post"> <!--action="login_check.php"-->
        <h1>Pyrogram</h1>
        <div class="input-box">
            <input type="text" id="username_email" name="username_email" placeholder=" ">
            <label for="username_email">Username or Email</label>
        </div>
        <div class="input-box">
            <input type="password" id="password" name="password" placeholder=" ">
            <label for="password">Password</label>
            <button type="button" class="show-password">Show</button>
        </div>
        <button type="submit" id="submit-button" name="login" value="login" disabled>Log In</button>
        <div class="reset-password">
            <a href="#">Forgotten your password?</a>
        </div>
    </form>
    <div class="container">
        Don't have an account?&nbsp;<a href="signup.php">Sign Up</a>
    </div>
</main>
</html>
