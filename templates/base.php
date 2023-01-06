<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title></title>
    <link rel="stylesheet" type="text/css" href="../css/navbar.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script type="text/javascript" src="../js/scroll_animation.js"></script>
</head>
<body>
    <!-- Top bar header -->
    <header class="navigation">
        <a class="logo no-underline" href="home.php">
            Pyrogram
        </a>
        <div class="navigation-search-container">
            <i class="fa fa-search"></i>
            <label>
                <input class="search-field" type="text" placeholder="Search">
            </label>
            <div class="search-container">
                <div class="search-container-box">
                    <div class="search-results">

                    </div>
                </div>
            </div>
        </div>
        <a class="messages-icon no-underline" href="messages.php">
            <img class="navbar-icon" src="../img/messages.png" alt="Messages">
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
            <a class="home-icon no-underline" href="home.php">
                <img class="navbar-icon" src="../img/home.png" alt="Home"/>
            </a>
            <a class="search-icon no-underline" href="search.php">
                <img class="navbar-icon" src="../img/search.png" alt="Search"/>
            </a>
            <a class="create-icon no-underline" href="create.php">
                <img class="navbar-icon" src="../img/create.png" alt="Create"/>
            </a>
            <a class="notifications-icon no-underline" href="notifications.php">
                <img class="navbar-icon" src="../img/notifications.png" alt="Notifications"/>
            </a>
            <a class="profile-icon no-underline" href="profile.php">
                <img class="navbar-icon" src="../img/profile.png" alt="Profile"/>
            </a>
    </nav>
</body>
</html>
