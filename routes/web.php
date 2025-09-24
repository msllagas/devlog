<?php

use App\Controllers\Auth\AuthController;
use App\Controllers\Auth\LoginController;
use App\Controllers\Auth\SignUpController;
use App\Controllers\Posts\PostController;
use App\Core\Middleware\Auth;
use App\Core\Middleware\Guest;
use App\Core\Router;

$router = new Router();

// Auth Controller
$router->get('/login', [LoginController::class, 'index'])->middleware(Guest::class);
$router->post('/login', [LoginController::class, 'store'])->middleware(Guest::class);
$router->get('/signup', [SignUpController::class, 'index'])->middleware(Guest::class);
$router->post('/signup', [SignUpController::class, 'store'])->middleware(Guest::class);
$router->post('/logout', [AuthController::class, 'logout'])->middleware(Auth::class);

// Post Controller
$router->get('/', [PostController::class, 'index']);
$router->get('/posts/{username}/{slug}', [PostController::class, 'show']);
$router->get('/posts/create', [PostController::class, 'create'])->middleware(Auth::class);
$router->post('/posts', [PostController::class, 'store']);
return $router;