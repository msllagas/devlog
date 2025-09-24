<?php

namespace App\Controllers\Auth;

class AuthController
{

    public function logout(): void
    {
        $_SESSION = [];
        session_destroy();

        header("Location: /login");
        exit;
    }
}