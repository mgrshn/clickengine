<?php

namespace App\Kernel\Auth;

use App\Kernel\Session\Session;
use App\Kernel\Database\Database;

class Auth implements AuthInterface
{
    public function __construct(
    private Database $database,
    private Session $session
    )
    {
    }

    public function login(string $email, string $password): bool
    {
        $user = $this->database->getFirstUserByEmail($email); 
        
        if (!$user) {
            return false;
        }

        if (!password_verify($password, $user->password))
        {
            return false;
        }

        $this->session->set('user_id', $user->id);
        return true;
    }

    public function logout(): void
    {
        $this->session->destroy();
    }
}