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
  
    if (findUserInDB($_POST['inputEmail'], $_POST['inputPassword']) == 'NO_USER_WITH_THAT_EMAIL' or findUserInDB($_POST['inputEmail'], $_POST['inputPassword']) == 'WRONG_PASSWORD') {
        $_SESSION['loginError'] = $err;
        $_SESSION['email'] = $_POST['inputEmail'];
        header('Location: ../pages/login.php');
        exit;
    }
    else {
        if ($_POST['stayInSystem'] == 'on') {
            setcookie("authorized", "/");
            setcookie("userEmail", $_POST['email'], "/");
        }
        else {
            setcookie("authorized", 1, time()+3600, "/");
            setcookie("userName", $_POST['email'], time()+3600, "/");
        }
        header('Location: ../pages/myPage.php');
    }
}