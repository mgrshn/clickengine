<?php

namespace App;

use App\Http\Request;
use App\Router\Router;

class App
{
    public function run(): void
    {
        $router = new Router();
        $request = new Request();
        
        $uri = $request->getUri();
        $method = $request->getMethod();
        
        $router->dispatch($uri, $method);
    }
}