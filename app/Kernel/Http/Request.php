<?php

namespace App\Kernel\Http;

class Request 
{
    private string $uri;
    private string $method;
    private array $post;

    public function __construct()
    {
        $this->uri = $_SERVER["REQUEST_URI"];
        $this->method = $_SERVER["REQUEST_METHOD"];
        $this->post = $_POST;
    }

    public static function initRequest(): static
    {
        return new static();
    }

    public function getUri()
    {
        return $this->uri;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getPostParams()
    {
        return $this->post;
    }
}
