<?php // Выход из уч. записи
if (isset($_SESSION['authorized'])) {
    unset($_SESSION['authorized']);
    unset($_SESSION['email']);
    echo '<script>location.replace("../index.php");</script>';
}