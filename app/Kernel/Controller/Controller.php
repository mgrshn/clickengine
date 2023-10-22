<?php

namespace App\Kernel\Controller;

use App\Kernel\Database\Database;
use App\Kernel\Http\Request;
use App\Kernel\Http\Response;
use App\Kernel\Auth\Auth;
use App\Kernel\Session\Session;

abstract class Controller
{
    private Request $request;
    private Response $response;
    private Session $session;
    private Database $database;
    private Auth $auth;

    public function request(): Request
    {
        return $this->request;
    }

    public function setRequest(Request $request): void
    {
        $this->request = $request;
    }

    public function response(): Response
    {
        return $this->response;
    }

    public function setResponse(Response $response): void
    {
        $this->response = $response;
    }

    public function session(): Session
    {
        return $this->session;
    }

    public function setSession(Session $session): void
    {
        $this->session = $session; 
    }

    public function db(): Database
    {
        return $this->database;
    }

    public function setDb(Database $database): void
    {
        $this->database = $database;
    }

    public function auth(): Auth
    {
        return $this->auth;
    }

    public function setAuth(Auth $auth): void
    {
        $this->auth = $auth;
    }
}