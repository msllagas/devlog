<?php

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$routes = [
    '/' => 'app/Controllers/index.php',
    '/post' => 'app/Controllers/post.php',
    '/login' => 'app/Controllers/Auth/login.php',
    '/signup' => 'app/Controllers/Auth/signup.php',
];

if (array_key_exists($uri, $routes)) {
    require $routes[$uri];
} else {
    require "views/404.php";
}
