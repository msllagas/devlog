<?php

namespace App\Controllers\Auth;

class SignUpController
{


    public function __invoke(): void
    {
        view('auth.signup');
    }
}