<?php

namespace App\Controllers\Auth;

use App\Core\Validator;

class SignUpController
{
    public function index(): void
    {
        view('auth.signup');
    }

    public function store(): void
    {
        $input = [
            'name' => trim($_POST['name'] ?? ''),
            'username' => trim($_POST['username'] ?? ''),
            'email' => trim($_POST['email'] ?? ''),
            'password' => $_POST['password'] ?? '',
            'password_confirmation' => $_POST['password-confirmation'] ?? '',
        ];

        $errors = [];

        if (!Validator::string($input['name'], 3, 50)) {
            $errors['name'] = 'Name must be between 3 and 50 characters.';
        }

        if (!Validator::string($input['username'], 3, 50)) {
            $errors['username'] = 'Username must be between 3 and 50 characters.';
        }

        if (!filter_var($input['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'A valid email address is required.';
        }

        if (!Validator::string($input['password'], 6, 255)) {
            $errors['password'] = 'Password must be at least 6 characters.';
        }

        if ($input['password'] !== $input['password_confirmation']) {
            $errors['password-confirmation'] = 'Passwords do not match.';
        }

        if (!empty($errors)) {
            view('auth.signup', compact('errors'));
            return;
        }
        $existingUser = db()->query("SELECT id 
                                    FROM users 
                                    WHERE email = LOWER(:email) 
                                    OR username = LOWER(:username)",
            [
                ':email' => strtolower($input['email']),
                ':username' => strtolower($input['username'])
            ]
        )->fetch();

        if ($existingUser) {
            $errors['email'] = 'Email or username already exists.';
            view('auth.signup', compact('errors'));
            return;
        }

        db()->query("INSERT INTO users (name, username, email, password) 
                   VALUES (:name, :username, :email, :password)",
            [
                ':name' => $input['name'],
                ':username' => $input['username'],
                ':email' => $input['email'],
                ':password' => password_hash($input['password'], PASSWORD_DEFAULT),
            ]
        );

        header("Location: /login");
        exit;
    }

}