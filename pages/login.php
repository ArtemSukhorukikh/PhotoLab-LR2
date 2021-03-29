<?php include_once('header.php') ?>
    <div class="container-sm" style="margin-top: 45px;">
        <form>
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Адрес эл. почты</label>
                <div class="col-sm-10">
                <input type="email" class="form-control" id="inputEmail3">
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-2 col-form-label">Пароль</label>
                <div class="col-sm-10">
                <input type="password" class="form-control" id="inputPassword3">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-10 offset-sm-2">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridCheck1">
                    <label class="form-check-label" for="gridCheck1">
                    Запомнить адресс эл. почты и пароль
                    </label>
                </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Вход</button>
            <a class="btn btn-outline-primary" href="../pages/registration.php" role="button">Регистрация</a>
            
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>
</html>