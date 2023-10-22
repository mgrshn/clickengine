<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;

class LoginController extends Controller
{
    public function index(): void
    {
        $authenticated = $this->session()->has('user_id');
        if ($authenticated) {
            $this->response()->withRedirect('home');
        }
        $response = $this->response();
        $response->render('login');
    }

    public function login(): void
    {
        $userData = $this->request()->getPostParams();

        $email = $userData["email"];
        $password = $userData["password"];

        $hasLoggedSuccesfull = $this->auth()->login($email, $password);

        if ($hasLoggedSuccesfull) {
            $this->response()->withRedirect('home');
        }

        $this->session()->set('errors', "Wrong email or password!");
        $this->response()->withRedirect('login');
    }

    public function logout(): void
    {
        $this->auth()->logout();
        $this->response()->withRedirect('login');
    }
}