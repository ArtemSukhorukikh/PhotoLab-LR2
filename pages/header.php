<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PhotoLab</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link href="css/styles.css" rel="stylesheet"/>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-xxl">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-camera2" viewBox="0 0 16 16">
                <path d="M5 8c0-1.657 2.343-3 4-3V4a4 4 0 0 0-4 4z"/>
                <path d="M12.318 3h2.015C15.253 3 16 3.746 16 4.667v6.666c0 .92-.746 1.667-1.667 1.667h-2.015A5.97 5.97 0 0 1 9 14a5.972 5.972 0 0 1-3.318-1H1.667C.747 13 0 12.254 0 11.333V4.667C0 3.747.746 3 1.667 3H2a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1h.682A5.97 5.97 0 0 1 9 2c1.227 0 2.367.368 3.318 1zM2 4.5a.5.5 0 1 0-1 0 .5.5 0 0 0 1 0zM14 8A5 5 0 1 0 4 8a5 5 0 0 0 10 0z"/>
            </svg>
            <a class="navbar-brand" href="../index.php">PhotoLab</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../index.php">Главная страница</a>
                    </li>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-1" type="search" placeholder="Поиск фотогаллереи" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Поиск</button>
                </form>
                <?php
                    if (isset($_COOKIE['authorized'])) {
                        echo "<a class=\"nav-link active\" aria-current=\"page\" href=\"../pages/login.php\">
                                {$_COOKIE['userName']}
                                </a>
                                <a class=\"nav-link\" aria-current=\"page\" href=\"../php/logout.php\">
                                    Выход
                                </a>";
                    }
                    else {
                        echo '<a class="nav-link active" aria-current="page" href="../pages/login.php">
                                Вход
                                </a>';
                    }
                ?>
            </div>
        </div>
      </nav>