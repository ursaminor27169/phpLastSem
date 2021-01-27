<?php

require $_SERVER['DOCUMENT_ROOT'].'/config/database.php';

use App\UsersController;

use App\ExpertSession;
use App\ExpertSessionLink;
use App\ExpertSessionAnswer;

$expert_session_link = ExpertSessionLink::Find($_GET['link_id']);

$expert_session = ExpertSession::Find($expert_session_link->expert_session_id);

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
                <li class="nav-item active">
                    <a class="nav-link" href="/">Главная</a>
                </li>
                <?php if (UsersController::isLogin()) { ?>
                    <li class="nav-login">
                        <span class="nav-login-label">Доброго дня, <b><?= $_SESSION['user']->login; ?></b>!</span>
                        <a href="/logout.php" class="btn nav-logout-btn">Выйти</a>
                    </li>
                <?php } else { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/signup.php">Зарегистрироваться</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/login.php">Войти</a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>

<!-- content -->
<main class="main container container-xl m-auto">
    <h2 class="mt-4 mb-4">
        Ответы
    </h2>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">IP адрес</th>
            <th scope="col">Дата</th>
            <?php foreach ($expert_session->questions as $experts_session_question) {
                $questions[] = $experts_session_question->options;
                ?>
                <th scope="col"><?= $experts_session_question->title; ?></th>
            <?php } ?>
        </tr>
        </thead>
        <tbody>
        <?php
        $answer_count = 0;
        $total_points = 0;
        foreach ($expert_session_link->answers as $experts_session_link_answer) {
            $points = 0;
            $json = json_decode($experts_session_link_answer->answer_json, 1);
            ?>
            <tr>
                <th><?= $experts_session_link_answer->author_ip; ?></th>
                <th><?= $experts_session_link_answer->created_at->format('d.m.y H:i'); ?></th>
                <?php foreach ($json['answer'] as $answer) { ?>
                    <th>
                        <?php
                        if (is_array($answer)) {
                            foreach($answer as $answer_value){
                                $points += json_decode($questions[$answer_count],1)[$answer_value];
                                $total_points += $points;
                            }
                            echo implode(',  ', $answer);
                        } else  echo $answer;
                        ?>
                    </th>
                <?php } ?>
            </tr>
            <?php
            $answer_count++;
        }
        $avg_points = $points / sizeof($questions);
        $total_avg_points = $total_points / sizeof($expert_session->questions()->count());
        ?>
        </tbody>
    </table>
    <h2 class="mt-4 mb-4">
        Итоги
    </h2>
    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Сумма</h5>
                    <p class="card-text">Сколько всего набрано баллов:</p>
                    <div class="btn btn-info disabled"><?=$points;?> баллов</div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Среднее значение</h5>
                    <p class="card-text">Какой средний балл:</p>
                    <div class="btn btn-info disabled"><?=$avg_points;?> баллов</div>
                </div>
            </div>
        </div>
    </div>
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
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0/dist/Chart.min.js"></script>
<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Вопрос 1', 'Вопрос 2', 'Вопрос 3'],
            datasets: [{
                label: 'Среднее кол-во баллов',
                data: [12, 19, 3],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>
</body>
</html>

