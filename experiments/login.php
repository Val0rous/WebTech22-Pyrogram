<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Google Form</title>
    <link rel="stylesheet" type="text/css" href="experiments/login_signup.css" />
</head>
<body>
    <div class="box">
        <div class="logo">
            Pyrogram
        </div>
    <form>
        <div class="inputBox">
            <input type="email" name="email" required onkeyup="/*this.setAttribute('value', this.value);*/"  value="">
            <label>Username</label>
        </div>
        <div class="inputBox">
              <input type="text" name="text" required onkeyup="/*this.setAttribute('value', this.value);*/" value="">
              <label>Password</label>
            </div>
        <input type="submit" name="sign-in" value="Sign In">
      </form>
    </div>
</body>
</html>