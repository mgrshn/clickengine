<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;

class HomeController extends Controller
{
    public function index(): void
    {
        $authenticated = $this->auth()->check();

        if (!$authenticated) {
            $this->response()->withRedirect('login');
        }

        $response = $this->response();
        $response->render('home');
    }
}