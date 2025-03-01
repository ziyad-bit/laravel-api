<?php

namespace App\Http\Middleware;

use Closure;
use App\Traits\General;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class AuthJwt extends BaseMiddleware
{
    use General;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'admins')
    {
        try {
            Auth::shouldUse($guard);

            JWTAuth::parseToken()->authenticate();

            return $this->checkAuth($request, $next);
        } catch (TokenExpiredException $e) {
            try {
                $newToken = auth()->refresh();

                /** Set the new token in the request,
                so subsequent calls in this request use the refreshed token.*/
                auth()->setToken($newToken);

                return $this->checkAuth($request, $next, $newToken);
            } catch (TokenExpiredException $e) {
                return $this->returnError("token is expired", 401);
            }
        } catch (TokenInvalidException $e) {
            return $this->returnError("token is invalid", 401);
        } catch (JWTException $e) {
            return $this->returnError("token is absent", 401);
        }
    }

    /**
     * @return mixed
     */

    public function checkAuth(Request $request,Closure $next,$newToken = null)
    {
        $record = auth()->user();

        if (!$record) {
            return $this->returnError("unauthenticated", 401);
        }

        $response = $next($request);

        if ($newToken) {
            return $response->cookie('refresh_token', $newToken, config('jwt.ttl'));
        }

        return $response;
    }
}
