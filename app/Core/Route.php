<?php

namespace App\Core;

/**
 * @method static Router get(string $pattern, $action)
 */
class Route
{
    protected static ?Router $router = null;
    public string $method;
    public string $pattern;
    /**
     * @var callable|string
     */
    public $action;
    public array $middleware = [];

    public function __construct(string $method, string $pattern, $action)
    {
        $this->method = $method;
        $this->pattern = $pattern;
        $this->action = $action;
    }

    public function middleware(string|array ...$middleware): self
    {
        $flattened = array_merge(...array_map(
            fn($m) => (array)$m,
            $middleware
        ));

        $this->middleware = array_merge($this->middleware, $flattened);

        return $this;
    }

    protected static function getRouter(): Router
    {
        if (!self::$router) {
            self::$router = new Router();
        }
        return self::$router;
    }

    public static function __callStatic(string $name, array $arguments)
    {
        $router = self::getRouter();

        if (!method_exists($router, $name)) {
            throw new \BadMethodCallException("Method {$name} does not exist on Router.");
        }

        return $router->$name(...$arguments);
    }



}
