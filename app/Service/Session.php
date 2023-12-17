<?php

namespace App\Service;

class Session
{
    public function set(string $key, array|string $value)
    {
        $_SESSION[$key] = $value;
    }

    public function unset(string $key)
    {
        unset($_SESSION[$key]);
    }

    public function get(string $key)
    {
        return $_SESSION[$key] ?? null;
    }

    public function flash(array $values)
    {
        $_SESSION['flash'] = $values;
    }

    public function get_flash(): array
    {
        $flash = [];

        if (isset($_SESSION['flash'])) {
            $flash = $_SESSION['flash'];
            unset($_SESSION['flash']);
        }

        return $flash;
    }
}
