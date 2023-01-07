<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title></title>
    <link rel="stylesheet" type="text/css" href="../css/navbar.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</head>
<body>
    <!-- Top bar header -->
    <header class="navigation">
        <a class="logo no-underline" href="home.php">
            Pyrogram
        </a>
        <a class="messages no-underline" href="messages.php">
            <img class="navbar-icon" src="../img/messages.png" alt="Messages">
            <span class="labels">Messages</span>
        </a>
    </header>

    <!-- Content to be added with PHP later -->
    <main>
    <?php
    if (isset($templateParams["name"])) {
        require("templates/".$templateParams["name"]);
    } else {
        //TODO: fix this shit
        //require("templates/index.php");
    }
    ?>
        <!-- scroll down test--->
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        <!-- scroll down test--->
    </main>

    <!-- Navigation bar -->
    <nav class="navigation">
        <a class="home no-underline" href="home.php">
            <img class="navbar-icon" src="../img/home.png" alt="Home"/>
            <span class="labels">Home</span>
        </a>
        <a class="search no-underline" href="search.php">
            <img class="navbar-icon" src="../img/search.png" alt="Search"/>
            <span class="labels">Search</span>
        </a>
        <a class="create no-underline" href="create.php">
            <img class="navbar-icon" src="../img/create.png" alt="Create"/>
            <span class="labels">Create</span>
        </a>
        <a class="notifications no-underline" href="notifications.php">
            <img class="navbar-icon" src="../img/notifications.png" alt="Notifications"/>
            <span class="labels">Notifications</span>
        </a>
        <a class="profile no-underline" href="profile.php">
            <img class="navbar-icon" src="../img/profile.png" alt="Profile"/>
            <span class="labels">Profile</span>
        </a>
    </nav>
</body>
</html>
