<?php

require 'operationsWithDB.php';
//var_dump($_POST);
unset($_SESSION['loginError']);
$err = [];
if (!empty($_POST['inputEmail'])) {
    if (!filter_var($_POST['inputEmail'], FILTER_VALIDATE_EMAIL)) {
        $err['INVALID_EMAIL'] = true;
    }
}
else {
    $err['NO_EMAIL'] = true;
}
if (empty($_POST['inputPassword'])) {
    $err['NO_PASSWORD'] = true;
}

if (count($err) != 0) {
    $_SESSION['loginError'] = $err;
    $_SESSION['email'] = $_POST['inputEmail'];
    header('Location: ../pages/login.php');
    exit;
}
else {
  
    if (!findUserInDB($_POST['inputEmail'], $_POST['inputPassword'])) {
        $_SESSION['loginError']['INVALID_EMAIL'] = true;
        $_SESSION['email'] = $_POST['inputEmail'];
        header('Location: ../pages/login.php');
        exit;
    }
    else {
        unset($_SESSION['loginError']);
        if ($_POST['stayInSystem'] == 'on') {
            setcookie("authorized", 1, path: "/");
            setcookie("userEmail", $_POST['inputEmail'], path: "/");
        }
        else {
            setcookie("authorized", 1, time()+3600, "/");
            setcookie("userName", $_POST['email'], time()+3600, "/");
        }
        header('Location: ../pages/myPage.php');
    }
}