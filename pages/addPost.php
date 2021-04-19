<?php // Страница добавления нового поста
include_once('../pages/header.php');
?>
<div class="container-sm" >
    <form enctype="multipart/form-data" action="../php/fileCheck.php" method="POST">
        <h1 class="display-2">Загрузка нового поста"</h1>
        <div class="">
            <label for="exampleFormControlTextarea1" class="form-label" style="font-size: large">Добавьте описание</label>
            <textarea name="description" class="form-control" id="exampleFormControlTextarea1" <?=(isset($_SESSION['description']) ? 'value='.$_SESSION['description'] : null)?> rows="3"></textarea>
        </div>
        <div>
            <input type="hidden" name="MAX_FILE_SIZE" value="3145728">
            <label for="formFileLg" class="form-label">Выберите файл</label>
            <input class="form-control form-control-lg" id="formFileLg" name="userFile" type="file">
        </div>
        <?php
        if (isset($_SESSION['inputFileError'])) {
            echo '<div class="alert alert-danger" role="alert">Отсутствует опизание поста или выбран неправильный файл для загрузки</div>';
        }
        ?>
        <input class="btn btn-primary my-2" type="submit" value="Отправить файл" />
    </form>
</div>

