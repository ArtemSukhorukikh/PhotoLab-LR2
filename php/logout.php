<?php
if (isset($_COOKIE['authorized'])) {
    setcookie("authorized", 1, time()-3600, "/");
    setcookie("userName", $_COOKIE['userName'], time()-3600, "/");
    echo '<script>location.replace("../index.php");</script>';
}