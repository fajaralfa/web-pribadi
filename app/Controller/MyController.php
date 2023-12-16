<?php

namespace App\Controller;

class MyController
{
    public function __invoke()
    {
        return 'This is from __invoke';
    }

    public function index()
    {
        return 'This is from index method';
    }
}
