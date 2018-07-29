<?php

namespace App\Http\Middleware;

use Closure;

class ApiGuard
{
    public function handle($request, Closure $next)
    {
        $secret = $request->header('secret');

        if($secret != env('API_SECRET')) {
            return api_response('request unauthorized', null, 401);
        }

        return $next($request);
    }
}
