<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Konstantinkotov\jwt\Resources\AccessDeniedResource;

class TokenCheckMiddleware extends Middleware
{
    public function handle($request, Closure $next, ...$guards)
    {
        [,$token] = explode(" ", $request->headers->get('Authorization'));
        if(!$token || !User::query()->where('api_token', $token)->exists()){
            return (new AccessDeniedResource());
        }

        return $next($request);
    }
}
