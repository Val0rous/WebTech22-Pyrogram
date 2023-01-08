<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="../css/login_signup.css" />
    <title>Login&nbsp;&bull;&nbsp;Pyrogram</title>
</head>
<main>
    <form action="../login_check.php" method="post">
        <h1>Pyrogram</h1>
        <div class="input-box">
            <label for="username_email">Username or email:</label><br>
            <input type="text" id="username_email" name="username_email"><br>
        </div>
        <div class="input-box">
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password"><br>
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
