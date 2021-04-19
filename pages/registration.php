<?php include_once('header.php') // Страница регистрации пользователя
?>
<div class="container-xxl">
    <form class="form-m" method="POST" action="../php/registrationCheck.php">
        <br/>
        <h1 class="display-6">Введите основные данные о себе</h1>
        <div class="row justify-content-start">
            <div class="col">
                <input type="text" class=<?php echo '"form-control '; 
                                            if (isset($_SESSION['registrationError']['INVALID_USER_FIRTS_NAME']) or isset($_SESSION['registrationError']['NO_USERFIRST_NAME'])) 
                                            {
                                                echo 'is-invalid"';
                                            }
                                            else 
                                            {
                                                echo '"';
                                            } 
                                            if (isset($_SESSION['userFirstName'])) 
                                            {
                                                echo "value=".$_SESSION['userFirstName'];
                                            } 
                                            else 
                                            {
                                                echo 'placeholder=Имя';
                                            } ?> 
                aria-label="First name" name="userFirstName">
                <?php
                    if (isset($_SESSION['registrationError']['INVALID_USER_FIRTS_NAME']) or isset($_SESSION['registrationError']['NO_USERFIRST_NAME'])) 
                    {
                        echo '<div id="validationServerUsernameFeedback" class="invalid-feedback">Использовано недопустимое имя</div>';
                    }
                ?>
            </div>
            <div class="col">
                <input type="text" class=<?php echo '"form-control '; 
                                            if (isset($_SESSION['registrationError']['INVALID_USER_LASTNAME']) or isset($_SESSION['registrationError']['NO_USER_LAST_NAME']))
                                            {
                                                echo 'is-invalid"';
                                            }
                                            else
                                            {
                                                echo '"';
                                            }
                                            if (isset($_SESSION['userLastName'])) 
                                            {
                                                echo "value=".$_SESSION['userLastName'];
                                            } 
                                            else 
                                            {
                                                echo 'placeholder="Фамилия"';
                                            }?>
                 aria-label="Last name" name="userLastName">
                <?php
                    if (isset($_SESSION['registrationError']['INVALID_USER_LASTNAME']) or isset($_SESSION['registrationError']['NO_USER_LAST_NAME'])) 
                    {
                        echo '<div id="validationServerUsernameFeedback" class="invalid-feedback">Использована недопустимая фамилия</div>';
                    }
                ?>
            </div>
            <div class="col">
                <input type="text" class=<?php echo '"form-control '; 
                                            if (isset($_SESSION['registrationError']['INVALID_USER_FATHERNAME']))
                                            {
                                                echo 'is-invalid"';
                                            }
                                            else
                                            {
                                                echo '"';
                                            }
                                            if (isset($_SESSION['userFatherName'])) 
                                            {
                                                echo "value=".$_SESSION['userFatherName'];
                                            } 
                                            else 
                                            {
                                                echo 'placeholder="Отчество"';
                                            } 
                                            ?>
                 aria-label="Last name" name="userFatherName">
                 <?php
                    if (isset($_SESSION['registrationError']['INVALID_USER_FATHERNAME'])) 
                    {
                        echo '<div id="validationServerUsernameFeedback" class="invalid-feedback">Использовано недопустимое отчество</div>';
                    }
                ?>
            </div>
        </div>
        <br/>
        <div class="form-floating mb-3">
            <input type="email" class=<?php echo '"form-control ';
                                        if (isset($_SESSION['registrationError']['INVALID_EMAIL']) or isset($_SESSION['registrationError']['NO_EMAIL']))
                                        {
                                            echo 'is-invalid"';
                                        }
                                        else
                                        {
                                            echo '"';
                                        }
                                        if (isset($_SESSION['email'])) 
                                        {
                                            echo "value=".$_SESSION['email'];
                                        } 
                                        else 
                                        {
                                            echo 'placeholder="name@example.com"';
                                        } 
                                        ?>
            id="floatingInput"  name="email">
            <label for="floatingInput">Адрес электронной почты</label>
            <?php
                if (isset($_SESSION['registrationError']['INVALID_EMAIL']) or isset($_SESSION['registrationError']['NO_EMAIL'])) 
                {
                    echo '<div id="validationServerUsernameFeedback" class="invalid-feedback">Использован недопустимый адрес электронной почты</div>';
                }
            ?>
        </div>
        <div class="form-floating">
            <div>
                <input type="password" class=<?php echo '"form-control ';
                if (isset($_SESSION['registrationError']['INVALID_PASSWORD']) or isset($_SESSION['registrationError']['NO_PASSWORD']))
                {
                    echo 'is-invalid"';
                }
                else
                {
                    echo '"';
                }?>
                id="exampleInputPassword1" placeholder="Введите пароль" name="password">
            </div>
            <br>
            <div>
                <input type="password" class=<?php echo '"form-control ';
                if (isset($_SESSION['registrationError']['INVALID_PASSWORD']) or isset($_SESSION['registrationError']['NO_PASSWORD']))
                {
                    echo 'is-invalid"';
                }
                else
                {
                    echo '"';
                }?>
                id="exampleInputPassword2" placeholder="Повторите пароль" name="password2">
                <?php
                if (isset($_SESSION['registrationError']['INVALID_PASSWORD']) or isset($_SESSION['registrationError']['NO_PASSWORD']))
                {
                    echo '<div id="validationServerUsernameFeedback" class="invalid-feedback">Использован недопустимый пароль или пароли не совпадают</div>';
                }
                ?>
            </div>
            <div id="passwordHelpBlock" class="form-text">
                Пароль должен содержать минимум 8 , состоять из символов верхнего регистра, а также цифры.
            </div>
        </div>
        <div class="form-check">
            <input class="form-check-input " type="checkbox" value="1" id="invalidCheck" name="flag" required>
            <label class="form-check-label" for="invalidCheck">
                Согласие на обработку персональных данный
            </label>
            <div id="invalidCheck" class="invalid-feedback">
                Отсутствие согласия на обработку персональных данный
            </div
        </div>
        <div class="d-grid gap-2 col-6 mx-auto">
            <button class="btn btn-primary" type="submit" name="submit">Зарегистрироваться</button>
        </div>
    </form>
</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>
</html>
<?php
    if (isset($_SESSION['registrationError'])) {
        unset($_SESSION['registrationError']);
    }
?>