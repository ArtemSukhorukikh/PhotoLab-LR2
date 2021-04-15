<?php

require 'operationsWithDB.php';

$err = [];
if (!empty($_POST['userFirstName'])) {
    if (!preg_match('/^[a-zA-Zа-яёА-ЯЁ]+$/u', $_POST['userFirstName']) == 1) {
        $err['INVALID_USER_FIRTS_NAME'] = true;
    }
}
else {
    $err['NO_USERFIRST_NAME'] = true;
}

if (!empty($_POST['userLastName'])) {
    if (!preg_match('/^[a-zA-Zа-яёА-ЯЁ]+$/u', $_POST['userLastName']) == 1) {
        $err['INVALID_USER_LASTNAME'] = true;
    }
}
else {
    $err['NO_USER_LAST_NAME'] = true;
}

if (!empty($_POST['userFatherName']) && !empty($_POST['userFatherName'])) {
    if (!preg_match('/^[a-zA-Zа-яёА-ЯЁ]+$/u', $_POST['userFatherName']) == 1) {
        $err['INVALID_USER_FATHERNAME'] = true;
    }
}

if (!empty($_POST['email'])) {
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $err['INVALID_EMAIL'] = true;
    }
}
else {
    $err['NO_EMAIL'] = true;
}

if (!empty($_POST['password']) && !empty($_POST['password2'])) {
    if ($_POST['password'] == $_POST['password2']) {
        if (!preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}$/", $_POST['password'])) {
            $err['INVALID_PASSWORD'] = true;
        }
    }
    else {
        $err['INVALID_PASSWORD'] = true;
    }
}
else {
    $err['NO_PASSWORD'] = true;
}


$_SESSION['userFirstName'] = $_POST['userFirstName'];
$_SESSION['userLastName'] = $_POST['userLastName'];
$_SESSION['userFatherName'] = $_POST['userFatherName'];
$_SESSION['email'] = $_POST['email'];
if (count($err) != 0) {
    $_SESSION['registrationError'] = $err;
    header('Location: ../pages/registration.php');
    exit;
}
else {
    if (addUserToDB($_POST['userFirstName'], $_POST['userLastName'], $_POST['userFatherName'], $_POST['email'], password_hash($_POST['password'], PASSWORD_DEFAULT))) {
        unset($_SESSION['userFirstName']);
        unset($_SESSION['userLastName']);
        unset($_SESSION['userFatherName']);
        $_SESSION['authorized'] = 1;
        header('Location: ../pages/myPage.php');
    }
    else {
        $_SESSION['registrationError']['INVALID_EMAIL'] = true;
        header('Location: ../pages/registration.php');
        exit;
    }
    
}