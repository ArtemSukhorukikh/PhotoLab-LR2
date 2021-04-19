<?php // Главная страница
    include_once('pages/header.php'); // Шапка сайта
    require_once ('php/operationsWithDB.php');
    unset($_SESSION);
    $photos = getLastPhotos();
?>
    <div class="container-lg">
        <!-- Stack the columns on mobile by making one full-width and the other half-width -->
        <div class="row">
            <div class="col-md">
                <h1 class="display-2">Добро пожаловать на сайт-фотогалерею "PhotoLab"</h1>
            </div>
        </div>
        <br/>
        <!-- Columns start at 50% wide on mobile and bump up to 33.3% wide on desktop -->
        <div class="row justify-content-between">
            <div class="col-6 col-md-4">
                <p class="lead">
                    Вы попали в интерактивный клуб, где наиболее удобно, полно и зрелищно реализовано общение энтузиастов фотоискусства со всего мира на русском языке! <br/>Участники могут показывать друг другу и тысячам зрителей фотографии.
                    PhotoLab дает неограниченные возможности приятного досуга и творческого роста одновременно.
                </p>
            </div>
            <div class="col-6 col-md-4"><img src="https://ykl-res.azureedge.net/fdfcb95c-9b10-4bc5-9b80-d7e26033ca69/dsc0017.jpg" class="img-thumbnail rounded float-start" alt="..."></div>
        </div>
        <!-- Columns are always 50% wide, on mobile and desktop -->
        <div class="row">
        <div class="col-md"><h1 class="display-2">Последние фотографии на "PhotoLab"</h1></div>
        </div>
        <div class="row justify-content-center">
            <?php foreach ($photos as $post) {?>
                <div class="card m-5" style="width: 18rem;">
                        <img src=<?=$post->urlPhoto?> class="card-img-top" alt="...">
                        <div class="card-body">
                            <p class="card-text"><?=$post->description?></p>
                            <p class="card-text"><?=$post->datePublication?></p>
                            <a href="pages\myPage.php?email=<?=$post->authorEmail?>" class="btn btn-primary">Перейти на страницу пользователя</a>
                        </div>
                </div>
            <?}?>
        </div>
        <br>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>
</html>