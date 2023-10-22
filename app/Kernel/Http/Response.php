<?php

namespace App\Kernel\Http;

use App\Kernel\Session\Session;

class Response
{
    private array $data = [];
    public function __construct(
        private Session $session
    )
    {
    }

    public function render(string $pageName): void
    {
        $page = __DIR__ . "/../../../views/$pageName.php";
        include_once $page;
    }

    public function withRedirect(string $redirectUri)
    {
        header("location: /$redirectUri");
        die();
    }

    public function setData(array $data): void
    {
        $this->data = $data;
    }

    public function getData(string $key): string
    {
        $dataArr =  $this->data;
        return $dataArr[$key] ?? '';
    }
}
