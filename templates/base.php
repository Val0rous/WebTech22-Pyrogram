<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title></title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
    <link rel="stylesheet" type="text/css" href="../css/navbar_style.css" />
</head>
<body>
    <!-- Top bar header -->
    <header>
        <h1>Pyrogram</h1>
        <input id="#messages" class="navbar-icon" type="image" src="../img/messages.png" alt="Messages">  <!-- Andrà modificato poi aggiungendo il collegamento alla pagina -->
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
    </main>

    <!-- Navigation bar -->
    <nav>
            <a href="home.php"><img class="navbar-icon" src="../img/home.png" alt="Home"/></a>
            <a href="search.php"><img class="navbar-icon" src="../img/search.png" alt="Search"/></a>
            <a href="create.php"><img class="navbar-icon" src="../img/create.png" alt="Create"/></a>
            <a href="notifications.php"><img class="navbar-icon" src="../img/notifications.png" alt="Notifications"/></a>
            <a href="profile.php"><img class="navbar-icon" src="../img/profile.png" alt="Profile"/></a>
            
            <!--
            <li><input type="image" src="home.png" alt="Home"></li>
            <li><input type="image" src="search.png" alt="Search"></li>
            <li><input type="image" src="create.png" alt="Create"></li>
            <li><input type="image" src="notifications.png" alt="Notifications"></li>
            <li><input type="image" src="profile.png" alt="Profile"></li>

            <li></li><a href="home.html">Home</a></li>
            <li><a href="search.html">Search</a></li>
            <li><a href="create.html">Create</a></li>
            <li><a href="notifications.html">Notifications</a></li>
            <li><a href="profile.html">Profile</a></li>
            -->
    </nav>
</body>
</html>
