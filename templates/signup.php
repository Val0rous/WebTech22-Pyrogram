<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign&nbsp;up&nbsp;&bull;&nbsp;Pyrogram</title>
    <link rel="stylesheet" type="text/css" href="css/login_signup.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <!--<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>-->
    <script src="js/login_signup.js"></script>
    <script src="js/signup.js"></script>
</head>
<main>
    <form id="signup-form" class="container" method="post">
        <h1>Pyrogram</h1>
        <div class="input-box">
            <input type="text" id="full_name" name="full_name" placeholder=" ">
            <label for="full_name">Full Name</label>
        </div>
        <div class="input-box">
            <input type="email" id="email" name="email" placeholder=" ">
            <label for="email">Email</label>
        </div>
        <div class="warning">
            <span class="invalid">
                <svg class="invalid" viewBox="0 0 24 24" role="img">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z">
                    </path>
                </svg>
            </span>
            <span class="message"></span>
        </div>
        <div class="input-box">
            <input type="text" id="username" name="username" placeholder=" ">
            <label for="username">Username</label>
        </div>
        <div class="warning">
            <span class="invalid">
                <svg class="invalid" viewBox="0 0 24 24" role="img">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z">
                    </path>
                </svg>
            </span>
            <span class="message">
                Username can contain letters, numbers, period and underscore
            </span>
        </div>
        <div class="input-box">
            <input type="password" id="password" name="password" placeholder=" ">
            <label for="password">Password</label>
            <button type="button" class="show-password">Show</button>
        </div>
        <div class="warning">
            <span class="invalid">
                <svg class="invalid" viewBox="0 0 24 24" role="img">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z">
                    </path>
                </svg>
            </span>
            <span class="message"></span>
        </div>
        <button type="submit" id="submit-button" name="signup" value="signup" disabled>Sign Up</button>
    </form>
    <div class="container">
        Already have an account?&nbsp;<a href="login.php">Log In</a>
    </div>
</main>
</html>
