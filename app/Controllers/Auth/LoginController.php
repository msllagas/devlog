<?php

namespace App\Controllers\Auth;

class LoginController
{

    public function __invoke(): void
    {
        view('auth.login');
    }

}