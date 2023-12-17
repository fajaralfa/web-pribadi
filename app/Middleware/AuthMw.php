<?php

namespace App\Middleware;

use App\Service\Session;

class AuthMw
{
    public function authenticated()
    {
        $session = new Session();
        if ($session->get('username') === null) {
            header('location: /login');
        }
    }

    public function unauthenticated()
    {
        $session = new Session();
        if ($session->get('username') !== null) {
            header('location: /home');
        }
    }
}
