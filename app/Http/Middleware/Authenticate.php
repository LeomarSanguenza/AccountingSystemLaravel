<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            return route('login'); // Ensure this is pointing to your login route
        }
    }
}

// class Authenticate extends Middleware
// {
//     public function handle($request, Closure $next, ...$guards)
//     {
//         return parent::handle($request, $next, ...$guards);
//     }
// }
