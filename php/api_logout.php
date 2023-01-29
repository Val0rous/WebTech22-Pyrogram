<?php
setcookie("user", null, -1, "/");
setcookie("token", null, -1, "/");
unset($_SESSION["user"]);