<?php

namespace App\Kernel\Session;

interface SessionInterface
{
    public function set(string $key, $value): void;

    public function get(string $key);

    public function has(string $key): bool;

    public function remove(string $key): void;

    public function getFlash(string $key);
    
    public function destroy();
}