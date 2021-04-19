<?php //Авторизация(вход)
require 'operationsWithDB.php';

unset($_SESSION['loginError']);
$err = []; // Массив ошибок

if (!empty($_POST['inputEmail'])) { //Проверка эл.почты
    if (!filter_var($_POST['inputEmail'], FILTER_VALIDATE_EMAIL)) {
        $err['INVALID_EMAIL'] = true;
    }
}
else {
    $err['NO_EMAIL'] = true;
}

if (empty($_POST['inputPassword'])) { // Проверка пароля
    $err['NO_PASSWORD'] = true;
}

if (count($err) != 0) {
    $_SESSION['loginError'] = $err;
    $_SESSION['email'] = $_POST['inputEmail'];
    header('Location: ../pages/login.php');
    exit;
}
else {
  
    if (!findUserInDB($_POST['inputEmail'], $_POST['inputPassword'])) { // Поиск пользователя в БД
        $_SESSION['loginError']['INVALID_EMAIL'] = true;
        $_SESSION['email'] = $_POST['inputEmail'];
        header('Location: ../pages/login.php');
        exit;
    }
    else {
        unset($_SESSION['loginError']);
        $_SESSION['authorized'] = 1;
        $_SESSION['email'] = $_POST['inputEmail'];
        header('Location: ../pages/myPage.php');
    }
}