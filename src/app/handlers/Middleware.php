<?php

namespace App\Middleware;

class Middleware
{
    public function boot()
    {
        return substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 5);
    }
}
