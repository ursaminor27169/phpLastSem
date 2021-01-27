<?php

namespace App;

class UsersController
{
    public static function login($login, $password): ?string
    {
        global $roles;
        $user = User::where('login', '=', $login)->first();
        if (!$user) return 'Пользователь не найден';
        if (!password_verify($password, $user->password)) return 'Неверный пароль';
        $_SESSION['user'] = $user;
        return null;
    }

    public static function logout(): void
    {
        session_destroy();
        header('Location: /');
    }

    public static function isLogin(): bool
    {
        if (!isset($_SESSION['user'])) return false;
        return ($_SESSION['user'] instanceof User);
    }
}
