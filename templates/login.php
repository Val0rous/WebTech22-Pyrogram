<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="css/login_signup.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="js/login.js" type="text/javascript"></script>
    <title>Login&nbsp;&bull;&nbsp;Pyrogram</title>
</head>
<main>
    <form id="login-form" method="post"> <!--action="login_check.php"-->
        <h1>Pyrogram</h1>
        <div class="input-box">
            <label for="username_email">Username or email:</label><br>
            <input type="text" id="username_email" name="username_email"><br>
        </div>
        <div class="input-box">
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password">
            <button type="button" class="show-password" onclick="">Show</button><br>
        </div>
        <button type="submit" name="login" value="login">Log In</button><br>
        Have some trouble logging in?
        <a>Reset your password</a>
    </form>
    <div>
        Don't have an account?
        <a href="signup.php">Sign Up</a>
    </div>
</main>
</html>
