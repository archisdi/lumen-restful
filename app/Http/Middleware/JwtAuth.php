<?php

namespace App\Http\Middleware;
use Exception;
use App\Models\User;
use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;

use Closure;

class JwtAuth
{
    public function handle($request, Closure $next)
    {
        $token = $request->header('token');

        if(!$token) {
            return api_response('token not provided', null, 401);
        }

        try {
            $credentials = JWT::decode($token, env('JWT_SECRET'), ['HS256']);
        } catch(ExpiredException $e) {
            return api_response('provided token is expired', null, 400);
        } catch(Exception $e) {
            return api_response('an error occured while decoding token', null, 400);
        }

        // find use and put it on the request class
        $user = User::find($credentials->sub);
        if (!$user) return api_response('user not found', null, 404);

        $request->auth = $user;
        return $next($request);
    }
}
