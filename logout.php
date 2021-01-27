<?php

require $_SERVER['DOCUMENT_ROOT'].'/config/database.php';

use App\UsersController;

UsersController::logout();