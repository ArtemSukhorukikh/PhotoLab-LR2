<?php


require 'operationsWithDB.php';

$err = [];
if (empty($_POST['description'])){
    $err['NO_DESCRIPTION'] = true;
}
if (!$_FILES['userFile']['type'] == 'image/jpeg') {
    $err['NO_JPEG_TYPE'] = true;
}
if (count($err) == 0){
    unset($_SESSION["inputFileError"]);
    unset($_SESSION["description"]);
    $uppLoadDir = '../userPhotos/';
    $uppLoadFile = $uppLoadDir.basename($_FILES['userFile']['name']);
    move_uploaded_file($_FILES['userFile']['tmp_name'],$uppLoadFile);
    addPost($_SESSION['email'], $uppLoadFile, $_POST['description']);
    header('Location: ../pages/myPage.php');
}
else {
    $_SESSION["inputFileError"] = $err;
    $_SESSION["description"] = $_POST["description"];
    header('Location: ../pages/addPost.php?email='.$_SESSION['email']);
    exit;
}

