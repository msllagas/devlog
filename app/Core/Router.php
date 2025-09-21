<?php

namespace App\Core;

class Router
{
    protected array $routes = [];

    public function get(string $uri, $action): Router
    {
        return $this->addRoute('GET', $uri, $action);
    }

    public function post(string $uri, $action): Router
    {
        return $this->addRoute('POST', $uri, $action);
    }

    /**
     * @param string $method
     * @param string $uri
     * @param $action
     * @return Router
     */
    public function addRoute(string $method, string $uri, $action): Router
    {
        $pattern = preg_replace('#\{[^/]+\}#', '([^/]+)', $uri);
        $pattern = "#^" . $pattern . "$#";
        $this->routes[$method][] = [
            'pattern' => $pattern,
            'action' => $action,
        ];
        return $this;
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