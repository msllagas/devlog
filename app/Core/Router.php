<?php

namespace App\Core;

class Router
{
    /**
     * @var Route[]
     */
    protected array $routes = [];

    public function get(string $uri, $action): Route
    {
        return $this->addRoute('GET', $uri, $action);
    }

    public function post(string $uri, $action): Route
    {
        return $this->addRoute('POST', $uri, $action);
    }

    /**
     * @param string $method
     * @param string $uri
     * @param $action
     * @return Route
     */
    public function addRoute(string $method, string $uri, $action): Route
    {
        $pattern = preg_replace('#\{[^/]+\}#', '([^/]+)', $uri);
        $pattern = "#^" . $pattern . "$#";

        $route = new Route($method, $pattern, $action);

        $this->routes[$method][] = $route;

        return $route;
    }

    /**
     * @throws \Exception
     */
    public function dispatch(string $method, string $uri)
    {
        foreach ($this->routes[$method] as $route) {
            if (preg_match($route->pattern, $uri, $matches)) {
                array_shift($matches);
                return $this->runMiddleware($route->middleware, function () use ($route, $matches) {
                    return $this->callAction($route->action, $matches);
                });
            }
        }
        abort();
    }

    public function runMiddleware(array $middleware, callable $next)
    {
        $pipeline = array_reduce(
            array_reverse($middleware),
            function ($next, $middleware) {
                $middleware = new $middleware();
                return $middleware->handle($next);
            },
            $next
        );
        return $pipeline();
    }

    /**
     * @throws \Exception
     */
    protected function callAction($action, array $params)
    {
        if (is_array($action) && class_exists($action[0])) {
            $controller = new $action[0]();
            return call_user_func_array([$controller, $action[1]], $params);
        }

        if (is_string($action) && class_exists($action)) {
            $controller = new $action();
            if (is_callable($controller)) {
                return call_user_func_array($controller, $params);
            }
        }

        if (is_callable($action)) {
            return call_user_func_array($action, $params);
        }

        throw new \Exception("Route action not callable.");
    }


}