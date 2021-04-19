<?php include_once('header.php'); // Страница авторизации
?>
    <div class="container-sm" style="margin-top: 45px;">
        <form method="POST" action="../php/loginCheck.php">
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Адрес эл. почты</label>
                <div class="col-sm-10">
                <input type="email" class=<?='"form-control'.((isset($_SESSION['loginError']) ? ' is-invalid"' : '"' ))?> id="inputEmail3" name='inputEmail' <?=(isset($_SESSION['loginError']) && !empty($_SESSION['email']) ? "value=".$_SESSION['email'] : null)?>>
                </div>
            </div>
            <div class="row mb-3 is-invalid">
                <label for="inputPassword3" class="col-sm-2 col-form-label">Пароль</label>
                <div class="col-sm-10">
                <input type="password" class=<?='"form-control'.((isset($_SESSION['loginError']['NO_PASSWORD'])) ? ' is-invalid"' : '"' )?> id="inputPassword3" name='inputPassword'>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Вход</button>
            <a class="btn btn-outline-primary" href="../pages/registration.php" role="button">Регистрация</a>
            <?=(isset($_SESSION['loginError']) ? '<div id="validationServerUsernameFeedback" class="invalid-feedback">Направильный адрес электронной почты или пароль</div>':null)?>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>
</html>