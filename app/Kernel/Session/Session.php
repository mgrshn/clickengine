<?php

namespace App\Kernel\Session;

class Session implements SessionInterface
{
    public function __construct()
    {
        session_start();
    }

    public function set(string $key, $value): void
    {
        $_SESSION[$key] = $value; 
    }

    public function get(string $key)
    {
        return $_SESSION[$key] ?? null;
    }

    public function has(string $key): bool
    {
        return isset($_SESSION[$key]);
    }

    public function remove(string $key): void
    {
        unset($_SESSION[$key]);
    }

    public function getFlash(string $key)
    {
        $value = $this->get($key);
        $this->remove($key);

        return $value;
    }

    public function destroy()
    {
        session_destroy();
    }
}