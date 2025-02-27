<?php

namespace App\Http\Middleware;

use Closure;
use App\Traits\General;
use App\Traits\ResourceMsg;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AuthJwt
{
    use General;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            JWTAuth::parseToken()->authenticate();

            return $next($request);           
        } catch (TokenExpiredException $e) {
            try {
                // Token has expired; refresh it.
                $newToken = auth()->refresh();
                
                // Set the new token in the request, so subsequent calls in this request use the refreshed token.
                auth()->setToken($newToken);  
                
                response()->cookie('refresh_token', $newToken, 180);

                return $next($request);           
            } catch (TokenExpiredException $e) {
                return $this->returnError("token is expired", 401);
            }
        } catch (TokenInvalidException $e) {
            return $this->returnError("token is invalid", 401);
        } catch (JWTException $e) {
            return $this->returnError("token is absent", 401);
        }
    }
}
