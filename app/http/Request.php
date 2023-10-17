<?php

namespace App\Http;

class Request
{
    private string $uri;
    private string $method;

    public function __construct()
    {
        $this->uri = $_SERVER["REQUEST_URI"];
        $this->method = $_SERVER["REQUEST_METHOD"];
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
