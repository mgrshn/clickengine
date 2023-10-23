<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;
use App\Kernel\Validator\Validator;

class RegisterController extends Controller
{
    public function index(): void
    {
        $authenticated = $this->auth()->check();
        if ($authenticated) {
            $this->response()->withRedirect('home');
        }

        $response = $this->response();
        $response->render('register');
    }

    public function register(): void
    {
        $request = $this->request();
        $session = $this->session();
        $db = $this->db();
        $userData = $request->getPostParams();

        $validatorErrors = Validator::validate($userData, [
            'email' => 'required|email|unique',
            'password' => 'required|min8'
        ], $db);

        if(!empty($validatorErrors)) {
            foreach ($validatorErrors as $errorField => $errorMessage) {
                $session->set($errorField, $errorMessage);
            }
            $this->response()->withRedirect('register');
        }
        
        $password = $userData['password'];
        $userData['password'] = password_hash($password, PASSWORD_DEFAULT);
        $db->insert('users', [
            'email' => $userData['email'],
            'password' => $userData['password']
            ]);

        $this->response()->withRedirect('login');
    }
}