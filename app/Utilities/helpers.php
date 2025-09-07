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
