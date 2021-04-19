<?php //Персональная таблица пользователя
    require 'header.php';
    require_once '../php/user.php';
    $userPage = new user();
    $userPage->getData((isset($_GET["email"]) ? $_GET["email"] : $_SESSION['email']),'email'); // Получение основной информации о пользователе
    $userPage->getUsersPostsData($userPage->email); // Получение постов пользователя
    $flagMyPage = isset($_SESSION['email']) ? $userPage->email == $_SESSION['email'] : false;
;?>
    <div class="container-xxl">
        <h1 class="display-2">Основная информация о пользователе</h1>
        <div class="row">
            <div class="col">
                <h6 class="display-6">Имя</h6>
            </div>
            <div class="col-8">
                <p class="lead" style="font-size: 2.5rem"><?=$userPage->name?></p>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <h6 class="display-6">Фамилия</h6>
            </div>
            <div class="col-8">
                <p class="lead" style="font-size: 2.5rem"><?=$userPage->secondName?></p>
            </div>
        </div>
        <?php
            if (!empty($userPage->fatherName)) {
                echo '<div class="row">
                         <div class="col">
                            <h6 class="display-6">Отчество</h6>
                         </div>
                         <div class="col-8">
                            <p class="lead" style="font-size: 2.5rem">';
                echo $userPage->fatherName.'</p>
                         </div>
                      </div>';
            }
        ?>
        <div class="row">
            <div class="col">
                <h6 class="display-6">Эл. Почта</h6>
            </div>
            <div class="col-8">
                <p class="lead" style="font-size: 2.5rem"><?=$userPage->email?></p>
            </div>
        </div>
        <?php
        if ($flagMyPage) {
            echo '<div class="row">
                    <div class="col">
                        <h6 class="display-6">Добавить новый пост</h6>
                    </div>
                    <div class="col-8">
                        <a href="addPost.php?email='.$userPage->email.'"lead" style="font-size: 2rem">Перейти на страницу добавления нового поста</a>
                    </div>
                    </div>';
        }?>
        <div class="row">
            <?php
                if (count($userPage->userPosts) != 0) {
                    for ( $i = 0; $i < min(count($userPage->userPosts),20); $i++) {
            ?>
                    <div class="card text-dark bg-light mb-3 m-2" style="width: 18rem;">
                    <img src=<?=$userPage->userPosts[$i]->urlPhoto?> class="card-img-top m-1" alt="...">
                        <div class="card-body">
                        <p class="card-text"><?=$userPage->userPosts[$i]->description ?></p>
                        </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><?=(empty($userPage->userPosts[$i]->middleRating) ? 'Оценок еще нет' : 'Средняя оценка: '.$userPage->userPosts[$i]->middleRating)?></li>
                        <li class="list-group-item"><?=(empty($userPage->userPosts[$i]->countRatings) ? 'Оценок еще нет' : 'Кол-во оценок: '.substr_count($userPage->userPosts[$i]->countRatings, ',')+1)?></li>
                        <li class="list-group-item"><?=$userPage->userPosts[$i]->datePublication ?></li>
                    </ul>
                    <div class="card-body">
                        <?php
                        if (!$flagMyPage) {
                            echo '
                                <form method="post" action="../php/addRating.php?idPost='.$userPage->userPosts[$i]->postId.'">
                                <select class="form-select" aria-label="Default select example" name="ratingValue">
                                    <option selected>Поставить оценку</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                                <button type="submit"  class="btn btn-primary my-2">Поставить оценку</button>
                                </form>
                            ';
                        }
                        ?>
                    </div>
                    </div>
                <?php }
                }
                    else {
                        echo '<h1 class="display-5">Пользователь еще не добавлял фотографии</h1>';
                    }
                ?>
        </div>
        <?php if (count($userPage->userPosts) != 0) {?>
        <h1 class="display-5">Просмотр галлереи пользователя</h1>
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src=<?=$userPage->userPosts[0]->urlPhoto?> class="d-block w-100" alt="...">
                </div>
                <?php for ($i = 1; $i < count($userPage->userPosts); $i++) {?>
                <div class="carousel-item">
                    <img src=<?=$userPage->userPosts[$i]->urlPhoto?> class="d-block w-100" alt="...">
                </div>
                <?php }?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
            <?php }?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>
</html>
