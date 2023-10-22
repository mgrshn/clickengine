<?php

namespace App\Kernel\Auth;

interface AuthInterface
{
    public function login(string $usernamem, string $password): bool;

    public function logout(): void;

}