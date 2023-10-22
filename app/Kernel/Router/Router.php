<?php

namespace App\Kernel\Router;

use App\Kernel\Database\Database;
use App\Kernel\Http\Request;
use App\Kernel\Http\Response;
use App\Kernel\Session\Session;
use App\Kernel\Controller\Controller;
use App\Kernel\Auth\Auth;

require_once "routes/web.php";

class Router
{
    private static array $routes = [
        'GET' => [],
        'POST' => [],
    ];

    public function __construct(
        private Request $request,
        private Response $response,
        private Session $session,
        private Database $database,
        private Auth $auth
        )
    {
    }

    public function dispatch(string $uri, string $method)
    {
        $routes = self::getRoutes($method);
        foreach ($routes as $routeName => $routeObject) {
            if ($routeName === $uri) {
                $action = $routeObject->getAction();
                if (is_array($action)) {
                    [$controller, $action] = $action;
                    
                    /**
                     * @var Controller $controller
                     */
                    $controller = new $controller();

                    $controller->setRequest($this->request);
                    $controller->setResponse($this->response);
                    $controller->setSession($this->session);
                    $controller->setDb($this->database);
                    $controller->setAuth($this->auth);

                    $controller->$action();
                } else {
                    $action();
                }
                die;
            }
        }
        $this->response->render('errors/404');
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