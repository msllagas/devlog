<?php

use App\Controllers\Auth\LoginController;
use App\Controllers\Auth\SignUpController;
use App\Controllers\Posts\PostController;
use App\Core\Router;

$router = new Router();

// Auth Controller
$router->get('/login', LoginController::class);
$router->get('/signup', SignUpController::class);

// Post Controller
$router->get('/', [PostController::class, 'index']);
$router->get('/posts/{username}/{slug}', [PostController::class, 'show']);
$router->get('/posts/create', [PostController::class, 'create']);
$router->post('/posts', [PostController::class, 'store']);
return $router;