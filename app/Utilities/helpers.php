<?php

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
    /**
     * Generate a short summary from content.
     *
     * @param string $content The full text
     * @param int $limit Maximum number of characters
     * @param bool $ellipsis Whether to append "..." if truncated
     * @return string
     */
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
