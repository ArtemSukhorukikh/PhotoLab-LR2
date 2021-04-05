<?php
include_once('../pages/header.php');
?>
<div class="container-sm" >
    <form>
        <h1 class="display-2">Загрузка нового поста"</h1>
        <div class="mb-5">
            <label for="exampleFormControlTextarea1" class="form-label" style="font-size: large">Добавьте описание</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
        <div class="input-group">
            <input type="file" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload" style="font-size: larger">
            <button class="btn btn-outline-secondary" type="button" id="inputGroupFileAddon04">Загрузить</button>
        </div>
    </form>
</div>

