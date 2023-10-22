<?php

namespace App\Kernel\Router;

class Route extends Router
{
    public function __construct(private string $uri, private string $method, private $action)
    {
    }

    public static function get(string $uri, $action)
    {
        $route = new static($uri, 'GET', $action);
        Router::addRoute($route);
        return $route;
    }

    public static function post(string $uri, $action)
    {
        $route = new static($uri, 'POST', $action);
        Router::addRoute($route);
        return $route;
    }

    public function getAction()
    {
        return $this->action;
    }

    public function getUri()
    {
        return $this->uri;
    }

    public function getMethod()
    {
        return $this->method;
    }
}