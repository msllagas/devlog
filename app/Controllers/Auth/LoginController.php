<?php

namespace App\Controllers\Auth;

class LoginController
{

    public function index(): void
    {
        view('auth.login');
    }

    public function store(): void
    {

        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        if (empty($username)) {
            $errors['username'] = 'Username is required.';
        }
        if (empty($password)) {
            $errors['password'] = 'Password is required.';
        }

        if (!empty($errors)) {
            view('auth.login', compact('errors'));
            return;
        }

        $user = db()->query("SELECT * FROM users 
                            WHERE username = :username",
            [
                ':username' => $username
            ]
        )->fetch();

        if (!$user || !password_verify($password, $user['password'])) {
            $errors['login'] = 'Invalid username or password.';
            view('auth.login', compact('errors'));
            return;
        }

        $_SESSION['user'] = [
            'id' => $user['id'],
            'username' => $user['username'],
        ];

        header("Location: /");
        exit;
    }


}