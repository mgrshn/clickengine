<?php

namespace App\Kernel\Container;

use App\Kernel\Database\Database;
use App\Kernel\Http\Request;
use App\Kernel\Http\Response;
use App\Kernel\Auth\Auth;
use App\Kernel\Session\Session;
use App\Kernel\Router\Router;

class Container
{
    public readonly Request $request;
    public readonly Response $response;
    public readonly Router $router;
    public readonly Session $session;
    public readonly Database $database;
    public readonly Auth $auth;

    public function __construct()
    {
        $this->registerServices();
    }

    private function registerServices()
    {
        $this->request = Request::initRequest();
        $this->session =  new Session();
        $this->response = new Response($this->session);
        $this->database = new Database();
        $this->auth = new Auth($this->database, $this->session);
        $this->router = new Router(
            $this->request,
            $this->response,
            $this->session,
            $this->database,
            $this->auth
        );
    }


}