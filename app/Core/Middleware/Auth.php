<?php

namespace App\Core\Middleware;

use App\Contracts\Middleware;

class Auth implements Middleware
{
    public function handle($next)
    {
        if (!isset($_SESSION['user'])) {
            header("Location: /");
            exit;
        }
        return $next;
    }


}