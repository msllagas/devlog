<?php

namespace App\Core;

class Router
{
    protected array $routes = [];

    public function add($method, string $uri, $action): self
    {
        $this->routes[] = [
            'method' => $method,
            'uri' => $uri,
            'action' => $action
        ];
        return $this;
    }

    public function get(string $uri, $action): void
    {
        $pattern = preg_replace('#\{[^/]+\}#', '([^/]+)', $uri);
        $pattern = "#^" . $pattern . "$#";

        $this->routes['GET'][] = [
            'pattern' => $pattern,
            'action' => $action,
        ];
    }

    public function post(string $uri, $action): void
    {   $pattern = preg_replace('#\{[^/]+\}#', '([^/]+)', $uri);
        $pattern = "#^" . $pattern . "$#";
        $this->routes['POST'][] = [
            'pattern' => $pattern,
            'action' => $action,
        ];
    }

    /**
     * @throws \Exception
     */
    public function dispatch(string $method, string $uri)
    {
        foreach ($this->routes[$method] as $route) {
            if (preg_match($route['pattern'], $uri, $matches)) {
                array_shift($matches);
                return $this->callAction($route['action'], $matches);
            }
        }
        abort();
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