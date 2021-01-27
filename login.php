<?php

require $_SERVER['DOCUMENT_ROOT'].'/config/database.php';

use App\UsersController;

if (UsersController::isLogin()) header('Location: /'); //Чтобы не сидел тут!

if ($post) {
    $error = UsersController::login($_POST['login'], $_POST['password']);
    if($error === null) header('Location: /');
}


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--	Add bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!--	Custom styles -->
    <link rel="stylesheet" href="/styles/main.css">
    <title>PHP</title>
</head>
<body>
<!-- Header with Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
    <div class="container">
		<img src="https://new.mospolytech.ru/local/templates/main/dist/img/logos/mospolytech-logo-white.svg" alt="logo" class="logo">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/">Главная</a>
                </li>
                <li class="nav-item">
                    <a
                            class="nav-link"
                            href="/signup.php"
                    >Регистрация</a>
                </li>
                <li class="nav-item active">
                    <a
                            class="nav-link"
                            href="/login.php"
                    >Войти</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<main class="main main__form container container-xl m-auto">
    <?php if (!empty($error)) { ?>
        <h3 class="text-danger"><?= $error; ?></h3>
    <?php } ?>
    <h3 class="modal-title">Здесь вы можете войти в свой аккаунт:</h3>
    <form method="post" name="sign-in-form" id="sign-in-form">
        <div class="form-group">
            <label for="sign-in-form-name" class="col-form-label">Введите логин:</label>
            <input name="login" required type="text" class="form-control" id="sign-in-form-name">
        </div>
        <div class="form-group">
            <label for="sign-in-form-password" class="col-form-label">А теперь пароль:</label>
            <input name="password" required type="password" class="form-control" id="sign-in-form-password">
        </div>
    </form>
    <button type="submit" form="sign-in-form" class="btn btn-primary">Войти</button>
</main>

<footer class="container-fluid footer">
    <p class="footer-item lead">
        Полякова Е.А
    </p>
    <p class="footer-item lead">
        191-321
    </p>
</footer>
<!-- bootstrap scripts-->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
