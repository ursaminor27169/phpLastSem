<?php
require $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';

use App\UsersController;
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
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/">Главная</a>
                </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/signup.php">Зарегистрироваться</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/login.php">Войти</a>
                    </li>
            </ul>
        </div>
    </div>
</nav>
<!-- create  -->
<main class="main main__center container container-xl m-auto">
	<h2 class="modal-name mt-5 mb-4">Вы ответили на все вопросы :)</h2>
	<span>А мы записали все ответы...</span>
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
<script>
 const selectEl = document.getElementById('question-type')
 const optionsList = document.getElementById('options-list')
 selectEl.addEventListener('change', (event) => {
 	const val = Number(event.target.value)
	 console.log('render', val)
	 if (val === 5 || val === 6) {
		 optionsList.style.display = 'block'
	 } else {
		 optionsList.style.display = 'none'
	 }
 })
//	options logic
	const optionBtn = document.getElementById('options-btn')
	const optionRender = document.getElementById('options-render')
	const optionInput = document.getElementById('options-input')
 const optionValue = document.getElementById('options-value')
 let options = []
 optionBtn.addEventListener('click', () => {
	  const val = optionInput.value
	  const el = document.createElement('li')
	  el.textContent = val
	 if (val) {
		 el.classList.add('options-item')
		 options.push(val)
		 optionRender.appendChild(el)
	 }
	 // clear
	 optionInput.value = ''
	 optionValue.value = options.join(',')
 })
</script>
</body>
</html>
