<?php

use App\Core\Database;

if (! function_exists('dd')) {
    function dd(...$vars) {
        echo "<pre>";
        foreach ($vars as $var) {
            var_dump($var);
        }
        echo "</pre>";
        die();
    }
}

if (!function_exists('env')) {
    /**
     * Get an environment variable.
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    function env(string $key, $default = null): mixed
    {
        if (array_key_exists($key, $_ENV)) {
            return $_ENV[$key];
        }

        if (array_key_exists($key, $_SERVER)) {
            return $_SERVER[$key];
        }

        $value = getenv($key);
        return $value !== false ? $value : $default;
    }
}

if (!function_exists('abort')) {
    function abort(int $code = 404, string $message = null): void
    {
        http_response_code($code);

        $view = __DIR__ . "/../../views/{$code}.php";

        if (file_exists($view)) {
            require $view;
        }

        exit;
    }
}

if (!function_exists('summary')) {
    function summary(string $content, int $limit = 80, bool $ellipsis = true): string
    {
        $cleanContent = strip_tags($content);
        if (strlen($cleanContent) <= $limit) {
            return $cleanContent;
        }

        $excerpt = substr($cleanContent, 0, $limit);

        return $ellipsis ? $excerpt . '...' : $excerpt;
    }
}

if (!function_exists('old')) {
    function old(string $key, $default = '') {
        return htmlspecialchars($_POST[$key] ?? $default);
    }
}

if (!function_exists('base_path')) {
    function base_path(string $path = ''): string
    {
        // go 2 directories up from app/Utilities → project root
        $base = dirname(__DIR__, 2);

        return $path ? $base . '/' . ltrim($path, '/') : $base;
    }
}

if (!function_exists('view')) {
      function view(string $path, array $data = []): void
    {
        $path = str_replace('.', '/', $path);

        extract($data);

        require base_path("views/{$path}.view.php");
    }
}

if (!function_exists('db')) {
    function db(): Database
    {
        static $instance;

        if ($instance === null) {
            $config = require base_path('config/database.php');
            $instance = new Database($config);
        }

        return $instance;
    }
}

