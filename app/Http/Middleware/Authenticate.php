<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Symfony\Component\HttpFoundation\Response;

class Authenticate extends Middleware
{
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route("login");
    }

    public function handle($request, Closure $next, ...$guards)
    {
        if ($sanctum = $request->cookie("rk-shop")) {
            $request->headers->set("Authorization", "Bearer " . $sanctum);
        }

        $this->authenticate($request, $guards);

        return $next($request);
    }
}
