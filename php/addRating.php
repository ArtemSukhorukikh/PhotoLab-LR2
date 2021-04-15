<?php
require 'operationsWithDB.php';
require '../pages/header.php';


$err = [];
if (!isset($_SESSION['authorized'])) {
    echo'
    <div class="alert alert-danger" role="alert">
        <h1 class="display-6">Вы не авторизированны в системе</h1>
    </div>';
    echo '<script>javascript:history.back()</script>';
    exit;
}
if ($_POST['ratingValue'] != 'Поставить оценку') {
    if (!checkRating($_GET['idPost'], $_SESSION['email'])) {
        addRating($_SESSION['email'], $_GET['idPost'], (integer)$_POST['ratingValue']);
    }
    else {
        $err['allreadySetRating'] = true;
    }
}

?>
<div class="container-xxl">
    <?php if (isset($err['allreadySetRating'])) {?>
    <div class="alert alert-danger" role="alert">
        <h1 class="display-6">Вы уже поставили оценку данной публикации</h1>
    </div>
    <? } else {?>
    <div class="alert alert-light" role="alert">
        <h1 class="display-6">Вы успешно поставили оценку данной публикации</h1>
    </div>
</div>
    <? }
    echo '<script>javascript:history.back()</script>';

    ?>


