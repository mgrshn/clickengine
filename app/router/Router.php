<?php

namespace App\Router;

require_once "routes/web.php";

class Router
{
    private static array $routes = [
        'GET' => [],
        'POST' => [],
    ];

    public function dispatch(string $uri, string $method)
    {
        $routes = self::getRoutes($method);
        foreach ($routes as $routeName => $routeObject) {
            if ($routeName === $uri) {
                $action = $routeObject->getAction();
                $action();
                die;
            }
        }
        require_once "views/errors/404.php";
    }

    protected static function addRoute($route)
    {
        self::$routes[$route->getMethod()][$route->getUri()] = $route;
    }

    private static function getRoutes(string $method): array
    {
        return self::$routes[$method];
    }
}