<?php
if (isset($_POST["email"]) &&
    isset($_POST["full_name"]) &&
    isset($_POST["username"]) &&
        isset($_POST["password"])) {
    echo $_POST["email"];
    echo $_POST["full_name"];
    echo $_POST["username"];
    echo $_POST["password"];
}
