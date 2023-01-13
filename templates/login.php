<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login&nbsp;&bull;&nbsp;Pyrogram</title>
    <link rel="stylesheet" type="text/css" href="css/login_signup.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <!--<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>-->
    <script src="js/login.js" type="text/javascript"></script>
</head>
<main>
    <form id="login-form" method="post"> <!--action="login_check.php"-->
        <h1>Pyrogram</h1>
        <div class="input-box">
            <input type="text" id="username_email" name="username_email" required onkeyup="this.setAttribute('value', this.value);" value=""><br>
            <label for="username_email">Username or email:</label><br>
        </div>
        <div class="input-box">
            <input type="password" id="password" name="password" required onkeyup="this.setAttribute('value', this.value);" value="">
            <label for="password">Password:</label><br>
            <button type="button" class="show-password">Show</button><br>
        </div>
        <button type="submit" id="submit-button" name="login" value="login">Log In</button><br>
        <div>
            Have some trouble logging in?&nbsp;<a>Reset your password</a>
        </div>
    </form>
    <div>
        Don't have an account?
        <a href="signup.php">Sign Up</a>
    </div>
</main>
</html>
